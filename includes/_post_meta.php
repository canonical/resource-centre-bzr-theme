<?php 
	$press_cats = array('news'); 
	if(in_category( $press_cats )) :
?>
<?php if ( is_single() ) : ?>
<div class="article-meta-wrap"><?php endif; ?>
<p class="article-meta"><?php echo $category; ?>
	<time datetime="<?php the_time('Y-m-d') ?>" ><?php the_time('j') ?><?php the_time(' F Y') ?>,</time> by <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="View <?php if(get_the_author_meta('first_name',$uid)): ?><?php the_author_meta('first_name',$uid); ?><?php else : ?><?php the_author_meta('display_name',$uid); ?><?php endif; ?>'s bio and posts"><span><?php the_author_meta('first_name',$uid); ?> <?php the_author_meta('last_name',$uid); ?></span></a>
</p>
</div>
<?php endif ; ?>
