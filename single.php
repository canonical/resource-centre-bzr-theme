<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Template
 *
 *
 * @file           single.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
get_header(); 
	$field = 'dbt_ga_tracking_label';
	$ga_conversion = get_post_meta($post->ID, $field, TRUE);
	$the_ga_code = $ga_conversion;
	$key = 'postVideo';
	$video_content = get_post_meta($post->ID, $key, TRUE);
	$lock = 'dbt_checkbox_gated';
	$gated_content = get_post_meta($post->ID, $lock, TRUE);
	$posted = $_GET['posted'];
	$postdate = get_the_time('sgymd');
	$postid = get_the_ID();
	$post_type = get_post_type_object( get_post_type($post) );
	global $wpdb;
	global $posted;
	$attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1");
	$articlecat = $category = get_the_category()->category_nicename; 
	$category = get_the_category();
	$category = $category[0]->category_nicename;
	$firstCategory = $category[0]->category_description;
	$registration = get_post_meta( $post->ID, '_event_registration', true );
?>

<?php get_template_part("includes/_cat_headings"); ?>

<div class="row no-border">
<?php if(($posted == $postdate . $postid)): // for gated content ?>
<div class="alert">
	<p>Thank you! Your download should start automatically. If it doesn't, <a class="" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>">download now</a>.</p>
</div><!-- /.alert -->
<?php endif; // end if(($posted == $postdate . $postid)) ?>

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<?php if(!current_user_can('administrator')){ echo setPostViews(get_the_ID()); } ?>
		
<div class="inner-wrapper">
	<div class="twelve-col no-margin-bottom">
		<h1 class="eight-col" itemprop="name"><?php the_title(); ?></h1>
	<div class="content eight-col no-margin-bottom">
		<?php if ($category == 'events') : ?>
			<?php get_template_part("/includes/_event_meta"); ?>
		<?php else : ?>
			<?php get_template_part("includes/_post_meta"); ?>
			<!-- <p><?php //post_read_time(); ?></p> -->
		<?php endif ; ?>
		<?php if(has_post_thumbnail()) : ?>
		<div itemprop="image" class="article-image">
		<?php if ( is_mobile_phone() ) : ?>
			<?php the_post_thumbnail('small'); ?>
		<?php else : ?>
		<?php if ($category == 'events') : else : ?>
			<?php the_post_thumbnail('large'); ?>
		<?php endif ; endif ; ?>
		</div><!-- /.article-image -->
		<?php endif ; ?>
		<?php //if(the_post_thumbnail_caption()) : echo "<p>", the_post_thumbnail_caption(), "</p>"; endif ; ?>
			<?php if('post' != get_post_type() && $gated_content == 'on') { the_content(); } ?>
			<?php if(($gated_content == 'on') && ($posted != $postdate . $postid)) { ?>
					<?php if($posted == $postdate . $postid ) { // check if the form has been posted ?>
					<?php } else { // show this if the form has not been posted ?>
					<?php if('post' == get_post_type()) the_excerpt(); ?>
					<div id="gated-content">
						<p>Please enter your details to view the <?php echo $post_type->labels->title_friendly; ?>  '<?php the_title(); ?>'</p>						
					<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?><?php echo $term->name; ?>
						
					<?php $theurl = rtrim(get_permalink(),'/'); ?>
					<iframe height="620" width="420" src="https://pages.ubuntu.com/confirmed-download-<?php $terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, 'topic', '', ', ', '' ) ); echo $terms_as_text; ?>.html?url_param=<?php echo $theurl; ?>?posted=<?php echo $postdate . $postid; ?>&amp;cat=<?php the_category_unlinked(''); ?>" name="iframe_w_param" id="iframe_w_param"></iframe>
					</div><!-- /#gated-content -->
					<?php } // end if market_form completed ?>
					
<?php } elseif(($gated_content == 'on' && $posted == $postdate . $postid)) { // show this if is gated and the form has been posted ?>

		<?php if ( get_post_meta($post->ID, 'postVideo', true) ) : ?>
					<div class="video-wrapper"><iframe class="post-video" width="596" height="335" src="https://www.youtube.com/embed/<?php echo $video_content; ?>?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
					<?php the_content(); ?>
		<?php else : ?>
		<?php if('post' == get_post_type()) : ?>
					<div itemprop="description"><?php the_content(); ?></div>
					<div id="download-item">
						<p><a class="link-cta-ubuntu" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>">Download  <?php $term_id = the_category_ID($echo=false); $saved_data = get_tax_meta($term_id,'ba_singular'); echo $saved_data; ?></a></p>
					</div>
		<?php else : ?>
					<iframe width="1" height="1" frameborder="0" src="<?php echo wp_get_attachment_url( $attachment_id ); ?>"></iframe>
		<?php endif; ?>
		<?php endif; // if video  ?>
			<?php } else { // show this if the post is not gated ?>
		<?php if ( get_post_meta($post->ID, 'postVideo', true) && ($category != 'news') ) : ?>
				<?php if ( !empty( $post->post_excerpt ) ) :	the_excerpt(); else : false; endif; ?>
					<div class="video-wrapper"><iframe class="post-video" width="596" height="335" src="https://www.youtube.com/embed/<?php echo $video_content; ?>?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
					<div itemprop="description"><?php the_content(); ?></div>
		<?php elseif('post' == get_post_type() || 'presskits' == get_post_type()) : ?>
					<div itemprop="description"><?php the_content(); ?></div>
					<?php if ($category != 'news') : ?>
						<?php $attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment') ); if ( $attachments ) : if (! wp_attachment_is_image($attachment_id) ) : ?>
					<div id="download-item">
						<p><a class="link-cta-ubuntu" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=download+link&amp;utm_content=<?php echo $post_type->labels->title_friendly, ''; ?>">Download  <?php $term_id = the_category_ID($echo=false); $saved_data = get_tax_meta($term_id,'ba_singular'); echo $saved_data; ?></a></p>
					</div><?php endif; endif; endif; // end if ( $attachments ) ?>
		<?php else : ?>
					<div itemprop="description"><?php the_content(); ?></div>
		<?php if(!$gated_content && $posted) : ?>
					<iframe width="1" height="1" src="<?php echo wp_get_attachment_url( $attachment_id ); ?>" style='display:none;'></iframe>
		<?php else : ?>
						<?php $attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment') );
							if ( $attachments ) : ?>
					<div id="download-item">
						<p><a class="link-cta-ubuntu" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=download+link&amp;utm_content=<?php echo $post_type->labels->title_friendly, ''; ?>">Download <?php single_cat_title(); ?></a></p>
					</div><?php endif ; // end if ( $attachments ) ?>
		<?php endif; ?>
		<?php endif; // if video  ?>
<?php } // end if gated ?>
				<?php if('event' == get_post_type()) : ?>
				<?php 
					$current_time = current_time('mysql'); 
					list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
					$current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;
					$event_timestamp = get_post_meta( $post->ID, '_start_eventtimestamp', true ); ?>
					<?php if(($current_timestamp <= $event_timestamp) && $registration) : ?>
					<div id="download-item">
						<p><a itemprop="url" class="link-cta-ubuntu" href="<?php echo $registration; ?>">Register now</a></p>
					</div>
					<?php endif; ?>
				<?php endif; // if event ?>

	</div><!-- /.eight-col -->

<div id="sidebar" class="four-col last-col instapaper_ignore">
<?php $attachments = get_children( array('exclude'     => get_post_thumbnail_id(), 'post_parent' => get_the_ID(), 'post_type' => 'attachment') ); if ((( $attachments )) && ($category == 'news')) : ?>

<?php get_template_part("includes/_downloads"); ?>


<?php $pressLinks = preg_split("/\\r\\n|\\r|\\n/", get_post_meta($post->ID, 'dbt_press_links', true ) );

if ( get_post_meta($post->ID, 'dbt_press_links', true) ) :  ?>
	<div class="press-release-videos four-col clearfix">
		<h2>Links</h2>
		<ul class="list no-bullets">
	<?php foreach ( $pressLinks as $pressLink ) : ?>
		 <li>
			 <?php echo $pressLink; ?>
     </li>
	<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php 
	if ( get_post_meta($post->ID, 'postVideo', true) ) : 
		get_template_part("includes/_videos"); 
	endif; 
?>

<?php 
$press_contact = make_clickable(get_post_meta( get_the_ID(), 'dbt_press_contact', true ));

// check if the custom field has a value
if( ! empty( $press_contact ) ) {
	echo '<h2>Contact details</h2>';
	echo '<div class="four-col clearfix">';
  echo wpautop( $press_contact, false );  
  echo '</div>';
} 
?>

<?php //get_template_part("includes/_subscribe"); ?>
<?php else : ?>
<?php get_template_part("includes/_related_posts"); ?>
<?php endif; // if category press-releases ends ?>
<?php endwhile; // while have_posts ends ?>
<?php endif; // if have_posts ends ?>

<?php if (($category == 'news') &&  (( $attachments ) && (! wp_attachment_is_image($attachment_id) )) ) : ?>
<?php else : ?>
<?php
wp_reset_query();
global $wpdb;
global $posted;
$queried_object = get_queried_object();  
$term_slug = $queried_object->slug; 
$custom_taxterms = wp_get_object_terms( $post->ID, 'topic', array('fields' => 'ids') );

  $args=array(
    'post_type' => 'productbusinesscard',
    'tax_query' => array(
	    array(
				'taxonomy' 	=> 'topic',
				'field' 		=> 'id',
				'terms'			=> $custom_taxterms
	    )
	),
    'post_status' 			=> 'publish',
    'posts_per_page' 		=> 1,
    'order' 						=> 'ASC',
    'orderby' 					=> 'date',
    'caller_get_posts'	=> 1
  );

    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <?php echo $title; ?>
			<div class="four-col product-business-card no-border box box-highlight">
				<div class="clearfix">
					<h2<?php if( ! is_single() ) : echo ' class="accessibility-aid"'; endif; ?>><span>What is&hellip;</span><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>
			</div>
        
<?php endwhile; } wp_reset_query(); ?>
<?php endif; // if ($category == array('news','press-releases')) ?>
</div><!-- /.instapaper_ignore -->
</div><!-- /.twelve-col -->
</div><!-- /.inner-wrapper -->
</div><!-- /.row --> 

<?php // dynamic_sidebar( 'search-sidebar' ); ?>	

<?php get_footer(); ?>
