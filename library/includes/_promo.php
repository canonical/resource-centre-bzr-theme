<?php
	global $post;
	$tmp_post = $post;
	$term = get_the_term_list( get_the_ID(), 'products-and-services' );
	
	$args = array( 
		'numberposts' => 1, 
		'post_type' => productbusinesscard,
		'products-and-services' => $term
	);
	$myposts = get_posts( $args );
	foreach( $myposts as $post ) : setup_postdata($post); ?>
		<div class="glossary-box box box-highlight <?php echo ' promo-', $term->slug; ?>">
			<h2><span>What is&hellip;</span><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div><!-- /.promo -->
	<?php endforeach; ?>
<?php $post = $tmp_post; ?>