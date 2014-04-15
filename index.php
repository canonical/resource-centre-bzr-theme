<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Index Template
 *
 *
 * @file           index.php
 * @package        Ubuntu blog theme
 * @author         Canonical Web Team
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/index.php
 * @link           http://codex.wordpress.org/Theme_Development#Index_.28index.php.29
 * @since          available since Release 1.0
 */

get_header(); ?><?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$style_classes = array('','',' last-col'); // cycle last col
$style_index = 0; // count for cycle
$postCount = 0;
$post_type = get_post_type_object( get_post_type($post) );
$category = get_the_category(); $press_cats = array('press-releases', 'news'); 
?><?php  /* ============== pull in featured ============== */


if(is_home() && !is_paged()) : ?><?php
    $my_query = new WP_Query('post_type=any&posts_per_page=1&meta_key=dbt_checkbox_featured_home&orderby=rand&order=DESC');
while ($my_query->have_posts()) : $my_query->the_post();
$post_type = get_post_type_object( get_post_type($post));
$do_not_duplicate[] = $post->ID;
?>
<div class="row featured-article <?php the_category_unlinked(' post-'); ?><?php if(in_category( $press_cats )) echo ' has-time'; ?>">
    <div class="inner-wrapper">
        <div class="eight-col no-margin-bottom">
            <h2>Editor's pick</h2>
					<?php if ('event' == get_post_type()) : ?>
						<?php get_template_part("includes/_event_meta"); ?>
					<?php else : ?>
						<?php get_template_part("content_home_featured"); ?>	
					<?php endif ; ?>
        </div><!-- /.eight-col -->
    </div><!-- /.inner-wrapper -->
</div><!-- /.row -->

<div class="article-list clearfix">
    <?php endwhile; ?><?php endif;
    /* ============== end pull in featured ============== */
    ?><?php /* ============== pull in latest events ============== */
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
    $query = new WP_Query( array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => $do_not_duplicate,
            'paged'=>$paged
        ));
    ?><?php if ( $query->have_posts() ) : ?>

    <div class="row">
        <div class="inner-wrapper">
            <div class="eight-col no-margin-bottom">
                <h2>Upcoming and recent events</h2>

                <ul class="no-bullets">
                    <?php
                        while( $query->have_posts() ):
												$query->the_post();
                        $do_not_duplicate[] = $post->ID ?>

                    <li><?php get_template_part("/includes/_event_meta"); ?></li><?php endwhile; ?>
                </ul>
            </div><!-- /.eight-col -->
        </div><!-- /.inner-wrapper -->
    </div><!-- /.row -->
    <?php endif; // if have_posts ends
    /* ============== end pull in latest events ============== */
    wp_reset_query();
    ?><?php /* ============== pull in latest cloud articles ============== */
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
    $query = new WP_Query( array(
            'posts_per_page' => 2,
            'topic' => 'cloud',
            'post_type' => 'any',
            'post__not_in' => $do_not_duplicate,
            'paged'=>$paged
        ));
    ?><?php if (have_posts()) : ?>

    <div class="row">
			<div class="inner-wrapper">
				<div class="eight-col no-margin-bottom">
					<h2>Ubuntu Cloud</h2>
					<ul class="no-bullets">
				    <?php
				        while( $query->have_posts() ):
								$query->the_post();
				        $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
					</ul>
				</div><!-- ./eight-col -->
			</div><!-- /.inner-wrapper -->
		</div><!-- /.row -->
    <?php endif; // if have_posts ends
    /* ============== end pull in latest cloud articles ============== */
    wp_reset_query();
    ?><?php
    /* ============== pull in latest server articles ============== */
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
    $query = new WP_Query( array(
            'posts_per_page' => 2,
            'topic' => 'server',
            'post_type' => 'any',
            'post__not_in' => $do_not_duplicate,
            'paged'=>$paged
        ));
    ?><?php if (have_posts()) : ?>

    <div class="row">
        <div class="inner-wrapper">
            <div class="eight-col no-margin-bottom">
                <h2>Ubuntu Server</h2>

                <ul class="no-bullets">
                    <?php
                        while( $query->have_posts() ):
                            $query->the_post();
                        $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
                </ul>
            </div><!-- ./eight-col -->
        </div><!-- /.inner-wrapper -->
    </div><!-- /.row -->
    <?php endif; // if have_posts ends

    /* ============== end pull in latest server articles ============== */
    wp_reset_query();
    ?>

    <div class="row">
        <div class="inner-wrapper vertical-divider">
            <?php
            /* ============== pull in latest phone articles ============== */
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
            $query = new WP_Query( array(
                    'posts_per_page' => 2,
                    'topic' => 'phone',
                    'order' => 'DESC',
                    'post_type' => 'any',
                    'post__not_in' => $do_not_duplicate,
                    'paged'=>$paged
                ));
            ?><?php if (have_posts()) : ?>

            <div class="six-col no-margin-bottom">
                <h2>Phone</h2>

                <ul class="no-bullets phone-articles">
                    <?php
                        while( $query->have_posts() ):
                            $query->the_post();
                        $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
                </ul>
            </div><!-- /.six-col -->
            <?php endif; // if have_posts ends
            /* ============== end pull in latest phone articles ============== */
            wp_reset_query();
            ?><?php
            /* ============== pull in latest tablet articles ============== */
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
            $query = new WP_Query( array(
                    'posts_per_page' => 2,
                    'topic' => 'tablet',
                    'post_type' => 'any',
                    'post__not_in' => $do_not_duplicate,
                    'paged'=>$paged
                ));
            ?><?php if (have_posts()) : ?>

            <div class="six-col last-col no-margin-bottom">
                <h2>Tablet</h2>

                <ul class="no-bullets no-margin-bottom">
                    <?php
                        while( $query->have_posts() ):
                            $query->the_post();
                        $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
                </ul>
            </div><!-- /.six-col -->
            <?php endif; // if have_posts ends

            /* ============== end pull in latest tablet articles ============== */
            wp_reset_query();
            ?>
        </div><!-- /.inner-wrapper -->
    </div><!-- /.row med-six-col -->
    <?php
    /* ============== pull in latest desktop articles ============== */
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
    $query = new WP_Query( array(
            'posts_per_page' => 2,
            'topic' => 'desktop',
            'post_type' => 'any',
            'post__not_in' => $do_not_duplicate,
            'paged'=>$paged
        ));
    ?><?php if (have_posts()) : ?>

    <div class="row">
        <div class="inner-wrapper">
            <div class="eight-col no-margin-bottom">
                <h2>Ubuntu Desktop</h2>

                <ul class="no-bullets">
                    <?php
                        while( $query->have_posts() ):
                            $query->the_post();
                        $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
                </ul>
            </div><!-- /.eight-col -->
        </div><!-- /.inner-wrapper -->
    </div><!-- /.row -->
    <?php endif; // if have_posts ends

    /* ============== end pull in latest desktop articles ============== */
    wp_reset_query();
    ?><?php /* ============== links to all topics ============== */ ?>

    <div class="row row-resource-list">
        <div class="inner-wrapper vertical-divider">
            <h2>All resources</h2>

            <ul class="no-bullets">
                <?php
                $style_classes = array('',' last-col');
                $style_index = 0;
                $taxonomy = 'topic';
                $terms = get_terms( $taxonomy, '' );
                if ($terms) {
                    foreach($terms as $term) {
                        if(($term->slug) != "tv") echo '<li class="six-col' . $style_classes[$style_index%2] . '">' . '<a href="' . $term->slug . '" ' . '>' . $term->name.' (' . $term->count . ')</a></li> ';
                        //(' . $term->count . ')
                        $style_index++;
                    }
                }
                ?>
            </ul>
        </div><!-- /.inner-wrapper -->
    </div><!-- /.row -->
    <?php
    //$terms = get_terms_by_post_type('tag','','snippet','name');
    wp_reset_query();
    ?><?php /* ============== end links to all topics ============== */ ?><?php //get_template_part("includes/_pagination"); ?>
</div><!-- /#articles -->
<?php get_footer(); ?>