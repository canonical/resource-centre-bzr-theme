<div class="article-meta">
	<ul class="no-bullets">
		<?
			$category = get_the_category(); 
			echo '<li><a href="/'.$category[0]->slug.'">'.$category[0]->cat_name.'</a></li>';
		?>
		<?php foreach(get_the_terms($post->ID, 'topic', '<li>', '&nbsp;</li><li>', '&nbsp;</li>' ) as $term)
     echo '<li><a href="/'.$term->slug. '"> '.$term->name.'</a>&nbsp;</li>' ?>
	</ul>
</div><!-- /.article-meta -->