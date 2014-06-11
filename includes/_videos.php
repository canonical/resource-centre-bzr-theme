<div class="press-release-videos four-col clearfix">
<h2>Videos</h2>
<?php $postVideos = explode(',',get_post_meta($post->ID, 'postVideo', TRUE));

     if($postVideos) : ?>
     <ul class="no-bullets">
     <?php foreach ( $postVideos as $postVideo ) : ?>
         	<li>
				 		<h3><?php $content = file_get_contents("https://youtube.com/get_video_info?video_id=".$postVideo); parse_str($content, $ytarr); echo $ytarr['title']; ?></h3>
					 	<div class="video-wrapper">
					 		<?php echo wp_oembed_get( 'https://www.youtube.com/watch?v=' . $postVideo ); ?>
					 	</div>
					 	<p>Embed code</p>
					 	<code>
					 		&lt;iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $postVideo; ?>" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;
					 	</code>
         	</li>
	<?php endforeach; ?>
     </ul>
      <?php endif; ?>
</div><!-- /.press-release-videos -->
