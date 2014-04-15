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
 
 /* Template Name: Press */
?>

<?php get_header(); 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$post = $wp_query->get_queried_object();
	$current_cat = basename(get_permalink());
?>
<div class="row row-hero cat-page-title no-border">
	<h1 class="cat-title inner-wrapper no-border"><?php wp_title(''); ?></h1>
</div>

<?php
/* ============== pull in business card ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = basename(get_permalink());
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'category_name' => $current_cat,
  'post_type' => 'productbusinesscard',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

<?php if ($query->have_posts()) : ?>

<?php 
	while( $query->have_posts() ): 
	$query->the_post(); 
	$do_not_duplicate[] = $post->ID ?>
	
			<div class="row glossary-box no-border<?php if( is_single() ) : echo ' box box-highlight'; endif; ?>">
				<div class="clearfix">
					<h2<?php if( ! is_single() ) : echo ' class="accessibility-aid"'; endif; ?>><span>What is&hellip;</span><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>
			</div>

<?php endwhile; ?>

<?php endif; // if have_posts ends 

/* ============== end pull in business card ============== */
?>

<?php
/* ============== pull in featured ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = basename(get_permalink());
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'category_name' => 'press-release,news',
	'meta_key' => 'dbt_checkbox_featured',
  'post_type' => 'any',
	'paged'=>$paged
	));
?>
<?php if ($query->have_posts()) : ?>
	<div class="row featured-article">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>Editor's pick</h2>
				<ul class="no-bullets">
		<?php 
			while( $query->have_posts() ): 
			$query->the_post(); 
			$do_not_duplicate[] = $post->ID ?>
		 
			<?php get_template_part("content_home"); ?>	
		<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->

<?php else : ?>	
<?php 
// The Query
	$new_query = new WP_Query( array(
	'posts_per_page' => 1,
	'category_name' => $current_cat,
  'post_type' => 'any',
	'paged'=>$paged
	));
?>
	<div class="row featured-article">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<ul class="no-bullets">
		<?php while( $new_query->have_posts() ): $new_query->the_post(); ?>
			<?php get_template_part("content_home"); ?>	
				
		<?php endwhile; wp_reset_postdata(); ?>
					</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->

<?php endif; // if have_posts ends 
/* ============== end pull in featured ============== */
?>

<div class="article-list">
<?php
/* ============== pull in latest events ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = basename(get_permalink());
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'post_type' => 'event',
	'category_name' => $current_cat,
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

<?php if ($query->have_posts()) : ?>
	<li class="row">
		<h2>Upcoming and recent events</h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); 
	$do_not_duplicate[] = $post->ID ?>

	<li>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php get_template_part("/includes/_event_meta"); ?>
	</li>

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in latest events ============== */
?>  
		
<?php
/* ============== pull in latest news articles ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = basename(get_permalink());
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'category_name' => 'news',
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

 
<?php if ($query->have_posts()) : ?>
	<div class="row">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>Latest news</h2>
				<ul class="no-bullets">
		<?php 
			while( $query->have_posts() ): 
			$query->the_post(); 
			$do_not_duplicate[] = $post->ID ?>
			
		 	<?php get_template_part("content_home"); ?>	
		
		<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; // if have_posts ends 

/* ============== end pull in latest press releases ============== */
?>

<?php
/* ============== pull in latest articles ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = basename(get_permalink());
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'category_name' => 'press-releases',
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

 
<?php if ($query->have_posts()) : ?>
	<div class="row">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
			<h2>Latest press releases</h2>
			<ul class="no-bullets">
	<?php 
		while( $query->have_posts() ): 
		$query->the_post(); 
		$do_not_duplicate[] = $post->ID ?>
		
	 	<?php get_template_part("content_home"); ?>	
	
	<?php endwhile; ?>
			</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; // if have_posts ends 

/* ============== end pull in latest press releases ============== */
?>


<?php
/* ============== pull in most viewed articles ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = basename(get_permalink());
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'category_name' => $current_cat,
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
  'meta_key' => 'post_views_count',
  'orderby' => 'meta_value_num',
	'paged'=>$paged
	));
?>

 
<?php if ($query->have_posts()) : ?>
	<li class="row">
		<h2>Most viewed <span><?php echo strtolower(wp_title( '', false, 'right' )); ?></span></h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); 
	$do_not_duplicate[] = $post->ID ?>
	
	<?php get_template_part("content_home"); ?>	

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in most viewed articles ============== */
?>
<?php get_footer(); ?>