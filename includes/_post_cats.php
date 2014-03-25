<ul class="no-bullets clearfix inline smaller">
<?php
foreach((get_the_category()) as $category) {
	if (($category->cat_name != 'Featured') && ($category->cat_name != 'E-book') && ($category->cat_name != 'Gated')) { ?>
<li><a href="<?php echo get_category_link( $category->term_id ); ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=internal+link&amp;utm_content=<?php echo $category->name; ?>"><?php echo $category->name; ?></a></li>
<?php }
}
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
