<?php $category = get_the_category(); $press_cats = array('press-releases', 'news'); ?>	
	<li<?php if(in_category( $press_cats )) echo ' class="has-time"'; ?>>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if(in_category( $press_cats )) : ?><time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time><?php endif ; ?>
		<p><?php echo get_excerpt(); ?></p>
		<?php get_template_part("/includes/_article_meta"); ?>
		<!--<p><?php //echo getPostViews(get_the_ID()); ?></p>-->
	</li>