<ul class="no-bullets clearfix inline smaller">
<?php $category = get_the_category();
echo '<li><a href="/'.$category[0]->slug.'">'.$category[0]->cat_name.'</a></li>';

$terms = get_the_terms( $post->ID , 'topic' );
if ($terms) :
	foreach( $terms as $term ) :
		echo '<li><a href="/'.$term->slug. '"> '.$term->name.'</a>&nbsp;</li>';
	unset($term);
endforeach;
endif;
?>
</ul>
