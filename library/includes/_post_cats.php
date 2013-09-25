					<ul class="no-bullets clearfix inline smaller">
							<?php
							foreach((get_the_category()) as $category) {
							    if (($category->cat_name != 'Featured') && ($category->cat_name != 'E-book') && ($category->cat_name != 'Gated')) {
							    	echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></li> '; 
							    	}
							    }
							?>	
							<?php echo get_the_term_list( get_the_ID(), 'products-and-services', '<li>', '</li><li>', '</li>' ); ?>
						</ul>
