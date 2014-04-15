<?php
	wp_reset_query();
	global $post, $wp_locale;
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$current_cat = basename(get_permalink());
	$category = get_category_by_slug($current_tax);
?>

<?php if (is_home()) : ?>
	<link rel="alternate" type="application/rss+xml" title="Ubuntu resources feed" href="<?php bloginfo('url'); ?>/feed/" />
<?php endif; // end is_home ?>

<?php if (is_search()) : $key = wp_specialchars($s, 1); ?>
	<link rel="alternate" type="application/rss+xml" title="Ubuntu resources '<?php echo $s; ?>' search feed" href="<?php bloginfo('url'); ?>/feed<?php echo $_SERVER['REQUEST_URI']; ?>" />
<?php endif; // end is_search ?>

<?php if (is_category()) : ?>
	<link rel="alternate" type="application/rss+xml" title="Ubuntu resources cat feed" href="<?php bloginfo('url'); ?>/feed/" />
<?php endif; // end is_category ?>

<?php if (is_category('topic')) : ?>
	<link rel="alternate" type="application/rss+xml" title="Ubuntu resources topic feed" href="<?php bloginfo('url'); ?>/feed/" />
<?php endif; // end is_category ?>