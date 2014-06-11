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
?>
<div class="row row-hero cat-page-title no-border">
	<h1 class="cat-title inner-wrapper no-border"><?php wp_title(''); ?></h1>
</div>

<?php
/* ============== pull in featured ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'category_name' => 'press-release,news',
  'post_type' => 'any',
	'paged'=>$paged
	));
?>
<?php if ($query->have_posts()) : ?>
	<div class="row featured-article">
		<div class="inner-wrapper">
			<div class="eight-col has-time">
		<?php
			while( $query->have_posts() ):
			$query->the_post();
			$do_not_duplicate[] = $post->ID ?>
			<?php if ('event' == get_post_type()) : ?>
				<?php get_template_part("includes/_event_meta"); ?>
			<?php else : ?>
				<?php get_template_part("content_home_featured"); ?>
			<?php endif ; ?>
		<?php endwhile; ?>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->

<?php else :

// The Query
	$new_query = new WP_Query( array(
	'posts_per_page' => 1,
	'category_name' => 'press-release,news',
  'post_type' => 'any',
	'paged'=>$paged
	));
?>
	<div class="row featured-article">
		<div class="inner-wrapper">
			<div class="eight-col has-time">
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

/* ============== end pull in latest news ============== */
?>
<?php /* ============== links to all news topics ============== */ ?>
	<div class="row row-resource-list">
		<div class="inner-wrapper vertical-divider">
    <div class="six-col">
		<h2>News by topic</h2>
			<ul class="no-bullets">
			<?php
				wp_reset_query();
				$current_tax = 'news';
				$category = $current_tax;
				$the_id = get_cat_ID('news');
	      $term_args = array(
	          'taxonomy' => 'topic',
	          'orderby' => 'slug',
	          'order' => 'ASC'
	      );
				$cats = get_categories($term_args);
				// loop through the categries
					foreach ($cats as $cat) :
						// setup the cateogory ID
	          $query_args = array(
							'post_type' => 'any',
							'posts_per_page' => '1',
							'cat' => $the_id,
							'topic' => $cat->name
						);

	          query_posts($query_args); //create our own custom query based on above arguments
						// start the wordpress loop!
				      if (have_posts()) : while (have_posts()) : the_post();
								echo "<li><a href='/category/" . $current_tax . "?topic=".$cat->slug."'>".$cat->name." (" .$wp_query->found_posts . ")</a></li>";
				      ?>
							<?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
					<?php endforeach; // done the foreach statement ?>

			</ul>
    </div><!-- /.six-col -->
    <div class="six-col last-col">
      <h2 class="clear">News by year</h2>
      <ul class="no-bullets">
<?php
     	$y = date( 'Y' ); // The current year.
		while ( $y > 2004 ) { // Pick a reasonable year you want this loop to end at, to save your server some time.
				$args = array(
					'posts_per_page' => -1,
					'cat'		 => 1189,
					'year'		 => $y
				);
				$cat_q = new WP_Query( $args );
				if ( $cat_q->have_posts() ) {
					$p = 0;
					while ( $cat_q->have_posts() ) {
						$cat_q->the_post();
						$p++;
					}
					?>
					<li>
						<a href="<?php bloginfo( 'url' ); ?>/category/news/year/<?php echo $y; ?>"><?php echo ' '.$y.' ('.$p.')'; ?></a>
					</li>
					<?php
				wp_reset_query();
			}
			$y--;
		}
		?>
	   </ul>
    </div><!-- /.six-col -->
	</div><!-- /.inner-wrapper -->
</div><!-- /.row -->
<?php /* ============== end links to all news topics ============== */
wp_reset_query();
?>

<?php /* ============== links to all topics ============== */ ?>
	<div class="row row-resource-list">
		<div class="inner-wrapper">
		<h2>Downloads</h2>
			<ul class="no-bullets list-downloads">
				<li class="three-col nav-products"><a href="/downloads/#download-products">Products</a></li>
				
				<li class="three-col nav-people"><a class="" href="/downloads/#download-people">People</a></li>
				
				<li class="three-col nav-logos"><a href="/downloads/#download-logos">Logos</a></li>
				
				<li class="three-col last-col nav-all-downloads"><a class="" href="/downloads">All downloads</a></li>
			</ul>
	</div><!-- /.inner-wrapper -->
</div><!-- /.row -->
			<?php /*
				wp_reset_query();
				$current_tax = 'downloads';
	      $term_args = array(
	          'taxonomy' => 'download-type',
	          'orderby' => 'slug',
	          'order' => 'DESC'
	      );
				$cats = get_categories($term_args);
				// loop through the categries
					foreach ($cats as $cat) :
						// setup the cateogory ID
	          $query_args = array(
							'post_type' => 'any',
							'posts_per_page' => '1',
							'category' => 'downloads'
						);

	          query_posts($query_args); //create our own custom query based on above arguments
						// start the wordpress loop!
				      if (have_posts()) : while (have_posts()) : the_post(); ?>
								<li class='three-col nav-<?php echo $cat->slug; ?>'><a class="" href='/category/<?php echo $current_tax; ?>?download-type="<?php echo $cat->slug; ?>'><?php echo $cat->name; ?><?php //echo $cat->name, ' (', $wp_query->found_posts, ')'; ?></a></li>
				      
							<?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
					<?php endforeach; // done the foreach statement ?>
					<li class="three-col last-col nav-all-downloads"><a class="" href="/category/downloads">All downloads</a></li>
			</ul>
	</div><!-- /.inner-wrapper -->
</div><!-- /.row -->
<?php /* ============== end links to all topics ============== 
wp_reset_query(); */
?>

<?php
/* ============== pull in about articles ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_tax = basename(get_permalink());
	$parent_page = get_page_by_title( 'About' );
	$parent_page_id = $parent_page->ID;
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'post_parent' => $parent_page_id,
  'post_type' => 'page',
  'post__not_in' => $do_not_duplicate,
	'orderby' => 'menu_order',
	'paged'=>$paged
	));
?>
 
<?php if ($query->have_posts()) : ?>
	<div class="row">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>About</h2>
				<ul class="no-bullets">
				<?php 
					while( $query->have_posts() ): 
					$query->the_post(); 
					$do_not_duplicate[] = $post->ID ?>

					<li<?php if(in_category( $press_cats )) echo ' class="has-time"'; ?>>
						<!-- <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> -->
						<p><?php echo the_excerpt(); ?></p>
						<p><a href="/about">Read more</a></p>
					</li>

				<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; 
wp_reset_query();  // Restore global post data 
// if have_posts ends
/* ============== end pull in about articles ============== */
?>

<?php
/* ============== pull in follow us ============== */ ?>
	<div class="row">
		<div class="inner-wrapper">
			<?php echo do_shortcode("[embed_post title='Follow us' excerpt='false' show_title='yes']"); ?>
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->

<?php 
wp_reset_query();  // Restore global post data 
// if have_posts ends
/* ============== end pull in follow us ============== */
?>

<div id="press-contact" class="row">
	<div class="inner-wrapper">
	<?php echo do_shortcode("[embed_post title='Contact']"); ?>
</div><!-- /.inner-wrapper -->
</div><!-- /.row -->

<?php get_footer(); ?>
