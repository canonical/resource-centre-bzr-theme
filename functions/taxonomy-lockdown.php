<?php
/**
 * Taxonomy Lockdown
 *
 * Backport of the editor taxonomy lockdown from the refactored theme
 * (git: functions/helpers/capabilities.php, functions/helpers/validation.php,
 * functions/taxonomies/{topic,group}.php). Targets PHP 7.4 / WordPress 6.4.
 *
 * Three vocabularies, three policies:
 *
 * - Categories mean exactly one thing since the site split: which blog a
 *   post appears on. The consuming apps filter on an allowlist of the five
 *   site category IDs, so a new category is a post that appears nowhere.
 *   The set is closed: Administrators only.
 * - Groups are a curated list from the stakeholder taxonomy sheet:
 *   Administrators only (capabilities set in custom_taxonomies.php).
 * - Tags are the open topic vocabulary, but creation must be a deliberate
 *   act on the Posts > Tags screen, never a side effect of typing in the
 *   post editor, which is how the vocabulary sprawled to ~2,100 terms.
 *
 * This file MUST load unconditionally (not behind is_admin()): the block
 * editor does all of its work over REST, where is_admin() is false.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Categories: create, rename and delete are Administrator-only.
 * ---------------------------------------------------------------------- */

/**
 * Remapped at registration rather than through map_meta_cap so every
 * consumer (admin screens, REST, the block editor's create affordance)
 * reads the same answer. `assign_terms` stays `edit_posts`, so filing
 * posts under the site categories is unchanged. Tags are deliberately
 * NOT remapped: editors keep full tag management on the Tags screen,
 * and rc_require_tags_screen_for_tag_creation() below handles the rest.
 */
function rc_lock_taxonomy_terms( $args, $taxonomy ) {
	if ( 'category' === $taxonomy ) {
		$args['capabilities'] = array(
			'manage_terms' => 'manage_categories', // Screen stays visible to editors.
			'edit_terms'   => 'manage_options',    // Create/rename: Administrators only.
			'delete_terms' => 'manage_options',
			'assign_terms' => 'edit_posts',        // Applying existing terms, unchanged.
		);
	}

	return $args;
}
add_filter( 'register_taxonomy_args', 'rc_lock_taxonomy_terms', 10, 2 );

/**
 * Backstop for categories and groups: pre_insert_term fires inside
 * wp_insert_term() itself, covering REST, classic admin and ajax alike.
 * No-user contexts (WP-CLI, imports, migration scripts) are exempt.
 */
function rc_block_term_creation( $term, $taxonomy ) {
	if (
		in_array( $taxonomy, array( 'category', 'group' ), true )
		&& get_current_user_id()
		&& ! current_user_can( 'manage_options' )
	) {
		return new WP_Error(
			'rc_term_creation_locked',
			__( 'New categories and groups can only be added by an administrator.' ),
			array( 'status' => 403 )
		);
	}

	return $term;
}
add_filter( 'pre_insert_term', 'rc_block_term_creation', 10, 2 );

/* -------------------------------------------------------------------------
 * Tags: creation is allowed on the Posts > Tags screen only.
 * ---------------------------------------------------------------------- */

/**
 * Capabilities cannot express a per-screen rule, but the insert path can be
 * identified here: the Tags screen's add form submits the `add-tag` admin
 * action, while the post editor creates tags over REST (Gutenberg) or as a
 * side effect of saving tax_input (classic, quick edit, bulk edit), none
 * of which carry that action. Editors keep core's default tag capabilities,
 * so the Tags screen itself needs no special-casing; Administrators and
 * no-user contexts (WP-CLI, migrations) are exempt entirely.
 *
 * Why a backstop is needed at all: for flat taxonomies WP's REST terms
 * controller only requires `assign_terms` to create a term (verified in
 * both 6.4 and 6.8 core), so capabilities alone cannot stop it.
 */
function rc_require_tags_screen_for_tag_creation( $term, $taxonomy ) {
	if ( 'post_tag' !== $taxonomy ) {
		return $term;
	}

	if ( ! get_current_user_id() || current_user_can( 'manage_options' ) ) {
		return $term;
	}

	// Nonce checking happens in the add-tag handler itself, before
	// wp_insert_term() runs; this only identifies the submission path.
	if ( isset( $_POST['action'] ) && 'add-tag' === $_POST['action'] ) {
		return $term;
	}

	return new WP_Error(
		'rc_tag_creation_locked',
		__( 'New tags are added from the Posts → Tags screen, not while editing a post.' ),
		array( 'status' => 403 )
	);
}
add_filter( 'pre_insert_term', 'rc_require_tags_screen_for_tag_creation', 10, 2 );

/* -------------------------------------------------------------------------
 * Topics: hidden from the block editor.
 * ---------------------------------------------------------------------- */

/**
 * The block editor builds its taxonomy panels from the REST taxonomy
 * object's `visibility.show_ui`, not from `meta_box_cb`, so it needs its
 * own switch (meta_box_cb / show_in_quick_edit are set in
 * custom_taxonomies.php). Reading topic data over REST is unaffected.
 */
function rc_hide_topic_editor_panel( $response, $taxonomy ) {
	if ( 'topic' === $taxonomy->name ) {
		$data = $response->get_data();
		if ( isset( $data['visibility'] ) ) {
			$data['visibility']['show_ui'] = false;
		}
		$response->set_data( $data );
	}

	return $response;
}
add_filter( 'rest_prepare_taxonomy', 'rc_hide_topic_editor_panel', 10, 2 );

/* -------------------------------------------------------------------------
 * Groups: the editor's picker only offers the approved vocabulary.
 * ---------------------------------------------------------------------- */

/**
 * The approved group slugs from the stakeholder taxonomy sheet.
 *
 * While this list is EMPTY the editor panel shows every group (filter
 * inactive). Once filled in, logged-in users only see these groups in the
 * editor's Groups panel; unauthenticated REST reads, which is how the
 * consumer sites fetch groups, are untouched, so existing /group/<slug>
 * pages keep working while legacy groups await cleanup. Legacy groups
 * already assigned to old posts stay assigned; they are only hidden from
 * the picker. Slugs missing in the database are skipped silently.
 */
const RC_APPROVED_GROUP_SLUGS = array(
	// 'internet-of-things',
	// 'security-and-compliance',
	// 'cloud-and-infrastructure',
	// 'enterprise-administration',
	// 'data-and-ai-ml',
	// 'ubuntu-and-linux',
	// 'developers-and-community',
	// 'hardware-enablement',
	// 'partners',
	// 'industries-and-verticals',
	// 'software-and-frameworks',
	// 'company',
);

function rc_limit_group_choices( $prepared_args, $request ) {
	$slugs = apply_filters( 'rc_approved_group_slugs', RC_APPROVED_GROUP_SLUGS );

	if ( empty( $slugs ) || ! is_user_logged_in() ) {
		return $prepared_args;
	}

	$ids = array();
	foreach ( $slugs as $slug ) {
		$term = get_term_by( 'slug', $slug, 'group' );
		if ( $term ) {
			$ids[] = (int) $term->term_id;
		}
	}

	if ( $ids ) {
		$prepared_args['include'] = empty( $prepared_args['include'] )
			? $ids
			: array_values( array_intersect( (array) $prepared_args['include'], $ids ) );
	}

	return $prepared_args;
}
add_filter( 'rest_group_query', 'rc_limit_group_choices', 10, 2 );

/* -------------------------------------------------------------------------
 * Site category required before an article can go live.
 * ---------------------------------------------------------------------- */

/**
 * Every consumer blog filters posts on an allowlist of the five site
 * categories, so a post carrying none of them is published into invisibility.
 * Guarded only at the transition into `publish` or `future` (`future` because
 * cron later publishes via wp_publish_post(), which bypasses these filters),
 * never on edits to posts already live, which would demote existing
 * uncategorised posts to draft the moment anyone touched them.
 *
 * TEMPORARILY DISABLED (2026-08-20): the three hook registrations below are
 * commented out so editors can still publish without a site category until
 * they have been told about the change. Re-enable by uncommenting them.
 */

/** Term IDs of the five site categories, resolved by slug and cached per request. */
function rc_site_category_ids() {
	static $ids = null;

	if ( null === $ids ) {
		$slugs = array( 'ubuntu-tech-blog', 'canonical-blog', 'cn-blog', 'jp-blog', 'announcements' );
		$ids   = array();
		foreach ( $slugs as $slug ) {
			$term = get_term_by( 'slug', $slug, 'category' );
			if ( $term ) {
				$ids[] = (int) $term->term_id;
			}
		}
	}

	return $ids;
}

/**
 * Would this save take the post live without a site category?
 *
 * @param int        $post_id  Post being saved, 0 for a new post.
 * @param string     $status   Status the post is being saved into.
 * @param array|null $incoming Categories submitted with the request, null if untouched.
 * @return bool True when the save must be refused.
 */
function rc_missing_site_category( $post_id, $status, $incoming ) {
	$goes_live = array( 'publish', 'future' );

	if ( ! in_array( $status, $goes_live, true ) ) {
		return false;
	}

	// Already live or scheduled: edits are not re-checked.
	if ( $post_id && in_array( get_post_status( $post_id ), $goes_live, true ) ) {
		return false;
	}

	$categories = is_array( $incoming )
		? array_map( 'intval', $incoming )
		: ( $post_id ? wp_get_post_categories( $post_id ) : array() );

	return ! array_intersect( $categories, rc_site_category_ids() );
}

function rc_missing_site_category_message() {
	return __( 'This article needs a site category (Ubuntu tech blog, Canonical blog, Cn blog, Jp blog or Announcements) before it can be published — without one it will not appear on any blog.' );
}

/** Block editor and REST clients: refuse the write with a proper error. */
function rc_rest_require_site_category( $prepared_post, $request ) {
	$post_id = isset( $prepared_post->ID ) ? (int) $prepared_post->ID : 0;
	$status  = isset( $prepared_post->post_status )
		? $prepared_post->post_status
		: ( $post_id ? get_post_status( $post_id ) : 'draft' );
	$incoming = isset( $request['categories'] ) ? (array) $request['categories'] : null;

	if ( rc_missing_site_category( $post_id, $status, $incoming ) ) {
		return new WP_Error(
			'rc_missing_site_category',
			rc_missing_site_category_message(),
			array( 'status' => 400 )
		);
	}

	return $prepared_post;
}
// add_filter( 'rest_pre_insert_post', 'rc_rest_require_site_category', 10, 2 );

/** Classic editor, quick-edit and bulk-edit: hold the post back as a draft. */
function rc_require_site_category_on_publish( $data, $postarr ) {
	if ( ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || 'post' !== $data['post_type'] ) {
		return $data;
	}

	$post_id  = isset( $postarr['ID'] ) ? (int) $postarr['ID'] : 0;
	$incoming = isset( $postarr['post_category'] ) ? (array) $postarr['post_category'] : null;

	if ( rc_missing_site_category( $post_id, $data['post_status'], $incoming ) ) {
		$data['post_status'] = 'draft';
		set_transient( 'rc_no_site_cat_' . get_current_user_id(), rc_missing_site_category_message(), 60 );
	}

	return $data;
}
// add_filter( 'wp_insert_post_data', 'rc_require_site_category_on_publish', 10, 2 );

/** Surface the reason a publish was held back. */
function rc_missing_site_category_notice() {
	$key     = 'rc_no_site_cat_' . get_current_user_id();
	$message = get_transient( $key );

	if ( $message ) {
		delete_transient( $key );
		printf( '<div class="notice notice-error"><p>%s</p></div>', esc_html( $message ) );
	}
}
// add_action( 'admin_notices', 'rc_missing_site_category_notice' );
