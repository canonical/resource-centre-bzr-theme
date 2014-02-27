<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Category Template
 *
 *
 * @file           taxonomy-topic.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/category.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28category.php.29
 * @since          available since Release 1.0
 */
?>

<?php get_header(); 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<div class="no-border">
<h1 class="row no-border cat-title"><?php single_tag_title(); ?><span></span></h1>

<div class="eight-col no-margin-bottom">
<?php get_template_part("includes/_business_card"); ?>

<ul class="article-list  no-bullets">
<?php
/* ============== pull in latest cloud articles ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_tax = get_query_var('topic');
	$query = new WP_Query( array(
	'topic' => $current_tax,
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>
 
<?php if ($query->have_posts()) : ?>
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); 
	$do_not_duplicate[] = $post->ID ?>
	
	<li class="row">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo get_excerpt(); ?></p>
		<?php get_template_part("/includes/_article_meta"); ?>
		<!--<p><?php //echo getPostViews(get_the_ID()); ?></p>-->
	</li>
<?php endwhile; endif; // if have_posts ends
/* ============== end pull in latest cloud articles ============== */ ?>

<div class="eight-col">
<?php get_template_part("includes/_pagination"); ?>
</div><!-- /.eight-col -->	

<?php /* ============== pull in topic specific cta ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_tax = get_query_var('topic');
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'topic' => $current_tax,
  'post_type' => 'topiccta',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>
 
<?php if ($query->have_posts()) : ?>
	<li class="row contextual-footer">
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); 
	$do_not_duplicate[] = $post->ID ?>
	
	<li>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</li>
	
<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in topic specific cta ============== */
?>
		
</ul>
	
</div><!-- /.eight-col -->
	
<?php get_footer(); ?>