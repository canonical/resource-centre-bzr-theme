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

<h1 class="off-left">Welcome to Ubuntu <?php bloginfo('name'); ?></h1>
<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$style_classes = array('','',' last-col'); // cycle last col
	$style_index = 0; // count for cycle
	$postCount = 0;
?>

<?php if(is_home() && !is_paged()) { ?>
<?php 
	$my_query = new WP_Query('post_type=any&posts_per_page=1&meta_key=dbt_checkbox_featured&orderby=date&order=DESC');
	while ($my_query->have_posts()) : $my_query->the_post();
	$thePostID = $post->ID;
	$post_type = get_post_type_object( get_post_type($post));
?>
<div class="row featured-article <?php the_category_unlinked(' post-'); ?>">
		<?php if(has_post_thumbnail()): ?>
			<div class="article-image six-col">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			</div><!-- /.article-image -->
		<?php endif //has_post_thumbnail ?>
	<div class="article-content six-col last-col">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part("library/includes/_article_meta"); ?>
			<p><?php echo get_excerpt(); ?></p>
		</div><!-- /.article-content -->
</div><!-- /.row -->

<div class="clearfix">
	<ul class="article-list clearfix no-bullets">
<?php endwhile; ?>
<?php } ?>
 
<?
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 10,
	'post_type' => $post_types,
	'paged'=>$paged
	));
?>

<?php if (have_posts()) : while( $query->have_posts() ): $query->the_post(); if( $post->ID == 				$do_not_duplicate ) continue;
	$lock = 'dbt_checkbox';
	$gated_content = get_post_meta($post->ID, $lock, TRUE);
	$number = get_comments_number($id);
	$key = 'postVideo';
	$video_content = get_post_meta($post->ID, $key, TRUE);
	$postCount = 0;
?>
<?php if($thePostID == $post->ID) {  } else { ?>
	<li class="row article <?php if(is_home() && !is_paged() && ++$postCount == 3) { echo ' last-col'; } ?><?php the_category_unlinked(' post-'); ?><?php $k = $style_index%3; echo "$style_classes[$k]"; $style_index++; ?><?php $post_type = get_post_type_object( get_post_type($post) );
echo ' post-', $post_type->labels->css_friendly; ?><?php if(has_post_thumbnail()): echo ' has-image'; endif; ?>">
			<?php if('video' == get_post_type()): ?>
			<div class="article-image six-col">
				<img src="http://img.youtube.com/vi/<?php echo $video_content; ?>/0.jpg" width="260" height="146" alt=""/>
			</div><!-- /.article-image -->
			<?php else : ?>
				<?php if(has_post_thumbnail()): ?>
			<div class="article-image six-col">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			</div><!-- /.article-image -->
				<?php endif; ?>
			<?php endif; ?>
			<div class="article-content six-col last-col">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php get_template_part("/library/includes/_article_meta"); ?>
			<?php if('event' == get_post_type()) : ?>
				<?php 
					$current_time = current_time('mysql'); 
					list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
					$current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;
					// Gets the event start month from the meta field
					$start_nummonth = get_post_meta( $post->ID, '_start_month', true );
					$start_month = get_post_meta( $post->ID, '_start_month', true );
					// Converts the month number to the month name
					$start_month = $wp_locale->get_month( $start_month );
					// Gets the event start day
					$start_day = get_post_meta( $post->ID, '_start_day', true );
					// Gets the event start year
					$start_year = get_post_meta( $post->ID, '_start_year', true );
					// Gets the event start hour
					$start_hour = get_post_meta( $post->ID, '_start_hour', true );
					// Gets the event start minute
					$start_minute = get_post_meta( $post->ID, '_start_minute', true );
					$end_nummonth = get_post_meta( $post->ID, '_end_month', true );
					$end_month = get_post_meta( $post->ID, '_end_month', true );
					// Converts the month number to the month name
					$end_month = $wp_locale->get_month( $end_month );
					// Gets the event start day
					$end_day = get_post_meta( $post->ID, '_end_day', true );
					// Gets the event start year
					$end_year = get_post_meta( $post->ID, '_end_year', true );
					// Gets the event start hour
					$end_hour = get_post_meta( $post->ID, '_end_hour', true );
					// Gets the event start minute
					$end_minute = get_post_meta( $post->ID, '_end_minute', true );
					$location = get_post_meta( $post->ID, '_event_location', true );
					$registration = get_post_meta( $post->ID, '_event_registration', true );
				?>
				</p>
				<dl class="event-details clearfix">
				<dt class="accessibility-aid">Location:</dt>
				<?php if ( $location ) : ?><dd class="location" itemprop="location" itemscope itemtype="http://schema.org/PostalAddress"><?php echo $location; ?></dd><?php endif; ?>
				<dt class="accessibility-aid">Date:</dt>
				<dd class="event-date">
					<?php if ($start_day != $end_day && $start_month == $end_month) : ?>
						<?php echo ltrim($start_day, '0') . '-' . ltrim($end_day, '0') . ' ' . $start_month . ' ' . $end_year; ?>
					<?php endif; ?>
					<?php if ($start_month != $end_month) : ?>
						<?php echo ltrim($start_day, '0') . ' ' . $start_month . ' - ' . ltrim($end_day, '0') . ' ' . $end_month . ' ' . $end_year; ?>
					<?php endif; ?>
					<?php if ($start_day == $end_day) : ?>
						<?php echo $start_day. ' ' . $start_month . ' ' . $end_year; ?>
					<?php endif; ?>
					<span class="accesibilty-aid">
						<time itemprop="startDate" datetime="<?php echo $start_year .'-' . $start_nummonth . '-' . $start_day . 'T' . $start_hour . ':' . $start_minute; ?>"></time></dd>
						<time itemprop="endDate" datetime="<?php echo $end_year .'-' . $end_nummonth . '-' . $end_day . 'T' . $end_hour . ':' . $end_minute; ?>"></time>
					</span>
				</dd>
			</dl>
		<?php endif; // event ?>
			<p><?php echo get_excerpt(); ?></p>
				<!--<p class="clearfix"><a href="<?php the_permalink(); ?>"><?php if('post' == get_post_type()) { echo 'Read article'; } elseif('video' == get_post_type()) { echo 'Watch video'; } elseif('case-studies' == get_post_type()) { echo 'Read case study'; } elseif('event' == get_post_type()) { echo 'View event details'; } else { ?>Read <?php echo $post_type->labels->title_friendly; ?><?php } ?>&nbsp;&rsaquo; <span class="off-left">'<?php the_title(); ?>' </span></a></p>-->
		</div><!-- /.article-content -->
	</li>
<?php } // end if($thePostID == $post->ID) ?>
<?php endwhile; ?>
<?php endif; // if have_posts ends ?> 
</ul>

<?php get_template_part("library/includes/_pagination"); ?>
</div><!-- /#articles -->

<?php 
	get_footer();
?>