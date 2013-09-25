<?php 
	$style_classes = array('',' last-col');
	$style_index = 0;
	$orig_post = $post;
	global $post;
	$tags = wp_get_post_tags($post->ID);
	$taxonomy = 'products-and-services';//  e.g. post_tag, category, custom taxonomy
	$param_type = 'products-and-services'; //  e.g. tag__in, category__in, but genre__in will NOT work

	if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	$args=array(
	'tag__in' => $tag_ids,
	'post_type' => 'any',
	'taxonomy'  => 'products-and-services',
  'post__not_in' => array($post->ID),
  'post_type' => $post_types,
	'ignore_sticky_posts'   => 1,
	'orderby' => 'rand',
	'posts_per_page' => 3, // Number of related posts that will be shown.
	'caller_get_posts'=>1
	);
	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) {
		  echo '<div class="related-posts clearfix">';
		  echo '<h2>You may also be interested in</h2><ul class="list clearfix no-bullets">';
	while( $my_query->have_posts() ) {
	$my_query->the_post(); ?>
	      <li class="six-col<?php $k = $style_index%2; echo "$style_classes[$k]"; $style_index++; ?>">
	      	<a class="" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?>&nbsp;&rsaquo;</a>
	      	<!--<span class="clearfix"><time datetime="<?php the_time('Y-m-d') ?>" ><?php the_time('j') ?><?php the_time(' F Y') ?>,</time> by <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php if(get_the_author_meta('first_name') == '') { ?><?php if(the_author_meta('display_name')) ?><?php } else { ?><?php if(the_author_meta('first_name')) ?> <?php if(the_author_meta('last_name')) ?><?php } ?> </a></span>-->
	      	<?php get_template_part("library/includes/_post_cats"); ?>
	      </li>
	<? }
	  echo '</ul>';
	  echo '</div><!-- /.related-posts -->';
	}
	}
$post = $orig_post;
wp_reset_query(); ?>