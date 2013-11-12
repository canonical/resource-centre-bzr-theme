<div class="related-posts clearfix">
<ul class="list clearfix no-bullets">
<?php
	$style_classes = array('',' last-col');
	$style_index = 0;
	$orig_post = $post;
	global $post;
	$tags = wp_get_post_tags($post->ID);
	$taxonomy = 'products-and-services';//  e.g. post_tag, category, custom taxonomy
	$param_type = 'products-and-services'; //  e.g. tag__in, category__in, but genre__in will NOT work
	$categories = get_the_category($post->ID);
	$category_ids = array();

$tags = wp_get_post_tags($post->ID);
if ($tags || $categories) {
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
	$args=array(
	'tag__in' => $tag_ids,
	'post_type' => 'any',
	'taxonomy'  => 'products-and-services',
  'post__not_in' => array($post->ID),
	'ignore_sticky_posts'   => 1,
	'posts_per_page' => 3, // Number of related posts that will be shown.
	'caller_get_posts'=>1
	);
	$my_query = new wp_query($args);
	if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) {
			$my_query->the_post();
		?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				<?php get_template_part("library/includes/_post_cats"); ?>
			</li>
		<?php
		}
	}
} else if ($categories) {

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args=array(
		'category__in' => $category_ids,
		'post_type' => 'any',
		'taxonomy'  => 'products-and-services',
		'post__not_in' => array($post->ID),
		'showposts'=>3, // Number of related posts that will be shown.
		'caller_get_posts'=>1
	);
		$my_query = new wp_query($args);
	if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) {
			$my_query->the_post();
		?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				<?php get_template_part("library/includes/_post_cats"); ?>
			</li>
		<?php
		}
	}
} ?>
</ul>
</div>