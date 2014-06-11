<?php
		$attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1");
		$current_cat = get_query_var('category_name');
?>

<?php if ($current_cat == 'downloads') : ?>
		<h3><a href="<?php echo wp_get_attachment_url( $attachment_id ); ?>"><?php echo $bytes; ?><?php the_title(); ?></a></h3>
<?php else : ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php endif ; ?>
		
		
		<?php $category = get_the_category(); $press_cats = array('press-releases', 'news'); if(in_category( $press_cats )) : ?><time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time><?php endif ; ?>
		<?php if($post->post_content == "") : ?>
		<?php else : ?>
		<p><?php echo get_excerpt(); ?></p>
		<?php endif ; ?>
	<?php get_template_part("/includes/_article_meta"); ?>
		<!--<p><?php //echo getPostViews(get_the_ID()); ?></p>-->
<?php /*	
	<?php if( !empty($post->post_excerpt) ) : ?>
		<?php the_excerpt(); ?>
	<?php else : ?>
		<p><?php echo get_excerpt(); ?></p>
	<?php endif ; ?>            
*/ ?>