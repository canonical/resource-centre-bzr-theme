<?php if ( is_single() ) : ?><div class="article-meta-wrap clearfix"><?php endif; ?>
<p class="article-meta">
	<time datetime="<?php the_time('Y-m-d') ?>" ><?php the_time('j') ?><?php the_time(' F Y') ?>,</time> by <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="View <?php if(get_the_author_meta('first_name',$uid)): ?><?php the_author_meta('first_name',$uid); ?><?php else : ?><?php the_author_meta('display_name',$uid); ?><?php endif; ?>'s bio and posts"><span><?php the_author_meta('first_name',$uid); ?> <?php the_author_meta('last_name',$uid); ?></span></a>
</p>

<?php if ( is_single() ) : ?>
	<ul class="save-links no-bullets inline instapaper_ignore">
		<li><a id="social-instapaper" href="http://www.instapaper.com/hello2?url=<?php echo urlencode( the_permalink( $post->ID ) ); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>" title="Add '<?php echo the_title(); ?>' to Instapaper">Add to Instapaper</a></li>
		<li><a id="social-pocket" href="http://getpocket.com/save?url=<?php echo urlencode( the_permalink( $post->ID ) ); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>" title="Add '<?php echo urlencode(the_title()); ?>' to Pocket">Add to Pocket</a></li>
	</ul>
</div>
<?php endif ; ?>