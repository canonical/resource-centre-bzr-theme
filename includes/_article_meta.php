<div class="article-meta">
	<ul class="no-bullets">
		<?php
$category = get_the_category();
echo '<li><a href="/'.$category[0]->slug.'">'.$category[0]->cat_name.'</a></li>';
?>

		<?php
// Get terms for post
$terms = get_the_terms( $post->ID , 'topic' );
if ($terms) :
	foreach( $terms as $term ) :
		echo '<li><a href="/'.$term->slug. '"> '.$term->name.'</a>&nbsp;</li>';
	unset($term);
endforeach;
endif;
?>
	</ul>
<!--<time datetime="<?php the_time('Y-m-d') ?>">
		<?php //the_time('j') ?><?php the_time(' F Y') ?>
</time> -->	
</div><!-- /.article-meta -->