<div class="related-posts clearfix">
<h2>You may also be interested in</h2>

<ul class="list clearfix no-bullets">
<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
	$args=array(
		'tag__in' => $tag_ids,
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
} 
else
$categories = get_the_category($post->ID);

 if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args=array(
		'category__in' => $category_ids,
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