	<li>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo get_excerpt(); ?></p>
		<?php get_template_part("/includes/_article_meta"); ?>
		<!--<p><?php //echo getPostViews(get_the_ID()); ?></p>-->
	</li>