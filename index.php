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

get_header(); ?>
<div class="row glossary-box glossary-box--home no-border<?php if( is_single() ) : echo ' box box-highlight'; endif; ?>">
    <div class="inner-wrapper">
        <div class="six-col">
            <h1>Ubuntu insights</h1>
            <p class="intro">Welcome to the home of all Ubuntu news, articles, tutorials, e-books and everything else in-between.</p>
        </div>
        <div class="six-col last-col"></div>
    </div>
</div>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$style_classes = array('','',' last-col'); // cycle last col
$style_index = 0; // count for cycle
$postCount = 0;
$post_type = get_post_type_object( get_post_type($post) );
$category = get_the_category();
$press_cats = array('press-releases', 'news');
?>

<section class="row <?php the_category_unlinked(' post-'); ?><?php if(in_category( $press_cats )) echo ' has-time'; ?>">
    <div class="inner-wrapper">
        <div class="eight-col">
        
<?php /* ============== pull in featured ============== */
if(is_home() && !is_paged()) : ?><?php
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$my_query = new WP_Query( array(
	'cat'	=> -$category->cat_ID,
	'meta_key' => 'dbt_checkbox_featured_home',
	'order' => 'DESC',
	'orderby' => 'date',
	'post_type' => 'post',
	'posts_per_page' => 1
));
while ($my_query->have_posts()) : $my_query->the_post();
$post_type = get_post_type_object( get_post_type($post));
$do_not_duplicate[] = $post->ID;
?>
<div class="box box-highlight eight-col">
    <h2>Featured</h2>
    <?php get_template_part("content_home_featured"); ?>	
</div><!-- /.featured-article -->
<?php endwhile; ?><?php endif;
/* ============== end pull in featured ============== */ ?>

<?php /* ============== pull in latest cloud articles ============== */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$query = new WP_Query( array(
    'cat'	=> -$category->cat_ID,
    'paged'=>$paged,
    'post__not_in' => $do_not_duplicate,
    'post_type' => 'post',
    'posts_per_page' => 2,
    'topic' => 'cloud'
));
?><?php if (have_posts()) : ?>

<div class="box eight-col">
	<h2>Ubuntu Cloud</h2>
    <?php
        while( $query->have_posts() ):
				$query->the_post();
        $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
</div><!-- ./eight-col -->
<?php endif; // if have_posts ends
wp_reset_query();
/* ============== end pull in latest cloud articles ============== */ ?>

<?php /* ============== pull in latest server articles ============== */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$query = new WP_Query( array(
    'cat'	=> -$category->cat_ID,
    'paged'=>$paged,
    'post__not_in' => $do_not_duplicate,
    'post_type' => 'post',
    'posts_per_page' => 2,
    'topic' => 'server'
));
?><?php if (have_posts()) : ?>

<div class="box eight-col">
    <h2>Ubuntu Server</h2>

        <?php
            while( $query->have_posts() ):
            $query->the_post();
            $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
</div><!-- ./eight-col -->
<?php endif; // if have_posts ends
wp_reset_query();
/* ============== end pull in latest server articles ============== */ ?>

<?php /* ============== pull in latest phone articles ============== */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$query = new WP_Query( array(
    'cat'	=> -$category->cat_ID,
    'order' => 'DESC',
    'paged'=>$paged,
    'post__not_in' => $do_not_duplicate,
    'post_type' => 'post',
    'posts_per_page' => 2,
    'topic' => 'phone'
    ));
?><?php if (have_posts()) : ?>
<div class="box eight-col">
<h2>Phone</h2>

    <?php
        while( $query->have_posts() ):
            $query->the_post();
			$do_not_duplicate[] = $post->ID ?>
			<?php if ('event' == get_post_type()) : ?>
				<?php get_template_part("includes/_event_meta"); ?>
			<?php else : ?>
				<?php get_template_part("content_home"); ?>
			<?php endif ; ?>
        <?php endwhile; ?>
</div><!-- ./eight-col -->
<?php endif; // if have_posts ends
wp_reset_query();
/* ============== end pull in latest phone articles ============== */ ?>

<?php /* ============== pull in latest tablet articles ============== */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$query = new WP_Query( array(
    'cat'	=> -$category->cat_ID,
    'paged'=>$paged,
    'post__not_in' => $do_not_duplicate,
    'post_type' => 'post',
    'posts_per_page' => 2,
    'topic' => 'tablet'
));
?>
<?php if (have_posts()) : ?>
<div class="box eight-col">
	<h2>Tablet</h2>
    <?php
        while( $query->have_posts() ):
									$query->the_post();
									$do_not_duplicate[] = $post->ID 
									 ?>
        <?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?>
    <?php endwhile; ?>
</div><!-- ./eight-col -->
<?php endif; // if have_posts ends
wp_reset_query();
/* ============== end pull in latest tablet articles ============== */ ?>

<?php /* ============== pull in latest desktop articles ============== */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$query = new WP_Query( array(
    'cat'	=> -$category->cat_ID,
    'paged'=>$paged,
    'post__not_in' => $do_not_duplicate,
    'post_type' => 'post',
    'posts_per_page' => 2,
    'topic' => 'desktop'
));
?><?php if (have_posts()) : ?>
<div class="box eight-col">
    <h2>Ubuntu Desktop</h2>

        <?php
            while( $query->have_posts() ):
                $query->the_post();
            $do_not_duplicate[] = $post->ID ?><?php if ('event' == get_post_type()) : ?><?php get_template_part("includes/_event_meta"); ?><?php else : ?><?php get_template_part("content_home"); ?><?php endif ; ?><?php endwhile; ?>
</div><!-- /.eight-col -->
<?php endif; // if have_posts ends
wp_reset_query();
/* ============== end pull in latest desktop articles ============== */ ?>

<?php /* ============== pull in latest events ============== */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
$exclude_cat = 'downloads';
$category = get_category_by_slug($exclude_cat);
$query = new WP_Query( array(
    'cat'	=> -$category->cat_ID,
    'order' => 'DESC',
    'orderby' => 'date',
    'paged'=>$paged,
    'post__not_in' => $do_not_duplicate,
    'post_type' => 'event',
    'posts_per_page' => 2
));
?><?php if ( $query->have_posts() ) : ?>

<div class="eight-col box box-highlight no-margin-bottom">
    <h2>Upcoming and recent events</h2>

    <ul class="no-bullets">
        <?php
            while( $query->have_posts() ):
									$query->the_post();
            $do_not_duplicate[] = $post->ID ?>

        <li><?php get_template_part("/includes/_event_meta"); ?></li><?php endwhile; ?>
    </ul>
</div><!-- /.eight-col -->
<?php endif; // if have_posts ends
 wp_reset_query();
/* ============== end pull in latest events ============== */ ?>

</div><!-- /.eight-col -->
  
<?php /* ============== links to all topics ============== */ ?>
<aside class="four-col last-col">
	<div class="box four-col">
    <h2>All topics</h2>
    <ul class="no-bullets">
        <?php
        $style_classes = array('',' last-col');
        $style_index = 0;
        $taxonomy = 'topic';
        $terms = get_terms( $taxonomy, '' );
        if ($terms) {
            foreach($terms as $term) {
                if(($term->slug) != "tv") echo '<li class="' . $style_classes[$style_index%2] . '">' . '<a href="' . $term->slug . '" ' . '>' . $term->name.'</a></li> ';
                $style_index++;
            }
        }
        ?>
    </ul>
	</div>
	<div class="box four-col">
			<?php get_template_part("includes/_share_links"); ?>
	</div>
</aside>
<?php //$terms = get_terms_by_post_type('tag','','snippet','name');
wp_reset_query(); ?>
<?php /* ============== end links to all topics ============== */ ?>
        
    </div>
</section>

<div class="article-list clearfix">
    
        
    

    
    <?php //get_template_part("includes/_pagination"); ?>
</div><!-- /#articles -->
<?php get_footer(); ?>