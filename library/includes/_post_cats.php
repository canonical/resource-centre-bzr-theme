					<ul class="no-bullets clearfix inline smaller">
							<?php
							foreach((get_the_category()) as $category) {
							    if (($category->cat_name != 'Featured') && ($category->cat_name != 'E-book') && ($category->cat_name != 'Gated')) { ?>
							    	<li><a href="<?php echo get_category_link( $category->term_id ); ?>" onclick="_gaq.push(['_trackEvent', 'Internal Link', '<?php the_title(); ?>', 'From category - '<?php echo $category->name; ?>' link']);"><?php echo $category->name; ?></a></li> 
							    <?php	}
							    }
							?>	
							<?php echo get_the_term_list( get_the_ID(), 'products-and-services', '<li>', '</li><li>', '</li>' ); ?>
						</ul>
