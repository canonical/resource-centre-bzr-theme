<div class="row single-post-cats">
	<div class="inner-wrapper">
		<h2 class="accessibility-aid">Posted under:</h2>
			<?php if(is_single() ) : ?>
				<ul class="no-bullets clearfix inline smaller">
					<?
						$category = get_the_category(); 
						echo '<li><a href="/'.$category[0]->slug.'">'.$category[0]->cat_name.'</a></li>';
					?>
					<?php foreach(get_the_terms($post->ID, 'topic', '<li>', '&nbsp;</li><li>', '&nbsp;</li>' ) as $term)
			     echo '<li><a href="/'.$term->slug. '">'.$term->name.'</a></li>' ?>
				</ul>
			<?php elseif ( is_home() || is_page( 'Webinars' ) || is_author() || is_search() ) : ?>
			<?php else : ?>
				<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?> <span><?php single_cat_title(); ?></span>
			<?php endif; ?>
	</div>
</div>