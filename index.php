<?
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

<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$style_classes = array('','',' last-col'); // cycle last col
	$style_index = 0; // count for cycle
	$postCount = 0;
?>

<?php 
/* ============== pull in featured ============== */

if(is_home() && !is_paged()) : ?>
<?php 
	$my_query = new WP_Query('post_type=any&posts_per_page=1&meta_key=dbt_checkbox_featured_home&orderby=date&order=DESC');
	while ($my_query->have_posts()) : $my_query->the_post();
	$post_type = get_post_type_object( get_post_type($post));
	$do_not_duplicate[] = $post->ID
?>
<div class="row featured-article <?php the_category_unlinked(' post-'); ?>">
		<h2>Editor's pick</h2>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo get_excerpt(); ?></p>
			<?php get_template_part("includes/_article_meta"); ?>
</div><!-- /.row -->

<div class="clearfix">
	<ul class="article-list clearfix no-bullets">
<?php endwhile; ?>
<?php endif; 
/* ============== end pull in featured ============== */
?>
 
<?php
/* ============== pull in latest events ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'post_type' => 'event',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
	$do_not_duplicate[] = $post->ID
?>

<?php if ( $query->have_posts() ) : ?> 
	<li class="row">
		<h2>Upcoming and recent events</h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); 
?>

	<li>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php get_template_part("/includes/_event_meta"); ?>
	</li>

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in latest events ============== */
wp_reset_query();
?>  

<?php
/* ============== pull in latest cloud articles ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'topic' => 'cloud',
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
	$do_not_duplicate[] = $post->ID
?>

 
<?php if (have_posts()) : ?> 
	<li class="row">
		<h2>Ubuntu Cloud</h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); ?>
	
	<?php get_template_part("content_home"); ?>	

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in latest cloud articles ============== */
wp_reset_query();
?>

<?php
/* ============== pull in latest server articles ============== */

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'topic' => 'server',
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
	$do_not_duplicate[] = $post->ID
?>
 
<?php if (have_posts()) : ?> 
	<li class="row">
		<h2>Ubuntu Server</h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); ?>
	
	<?php get_template_part("content_home"); ?>	

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in latest server articles ============== */
wp_reset_query();
?>    

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
	$do_not_duplicate[] = $post->ID
?>
 
<?php if (have_posts()) : ?> 
	<li class="row">
		<h2>Ubuntu on phones</h2>
		<ul class="no-bullets phone-articles">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); ?>
	
	<?php get_template_part("content_home"); ?>	

<?php endwhile; ?>
		</ul>
<?php endif; // if have_posts ends 

/* ============== end pull in latest phone articles ============== */
wp_reset_query();
?>    

<?php
/* ============== pull in latest tablet articles ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'topic' => 'tablet',
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
	$do_not_duplicate[] = $post->ID
?>
 
<?php if (have_posts()) : ?> 
		<h2>Ubuntu on tablets</h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); ?>
	
	<?php get_template_part("content_home"); ?>	

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in latest tablet articles ============== */
wp_reset_query();
?>    

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
	$do_not_duplicate[] = $post->ID
?>
 
<?php if (have_posts()) : ?> 
	<li class="row">
		<h2>Ubuntu Desktop</h2>
		<ul class="no-bullets">
<?php 
	while( $query->have_posts() ): 
	$query->the_post(); ?>
	
	<?php get_template_part("content_home"); ?>	

<?php endwhile; ?>
		</ul>
	</li>
<?php endif; // if have_posts ends 

/* ============== end pull in latest desktop articles ============== */
wp_reset_query();
?>    

<?php /* ============== links to all topics ============== */ ?>
	<li class="row row-resource-list">
		<h2>All resources</h2>
		<ul class="no-bullets">
			<?php 
				$taxonomy = 'topic';
				$terms = get_terms( $taxonomy, '' );
				if ($terms) {
					foreach($terms as $term) {
						if(($term->term_id) != "303") echo '<li>' . '<a href="' . $term->slug . '" ' . '>' . $term->name.'</a></li> ';
						//(' . $term->count . ')
					}
				} 
			?>
		</ul>
	</li>	
<?php 
//$terms = get_terms_by_post_type('tag','','snippet','name');
wp_reset_query();
?>
	
	
<?php /* ============== end links to all topics ============== */ ?>

</ul>
<?php //get_template_part("includes/_pagination"); ?>
</div><!-- /#articles -->

<?php get_footer(); ?>