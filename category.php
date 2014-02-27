<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Category Template
 *
 *
 * @file           category.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/category.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28category.php.29
 * @since          available since Release 1.0
 */
?>

<?php get_header(); 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<div class="no-border">
<div class="row no-border">
	<h1><?php if(is_taxonomy('topic', 'category')) : echo 'Your search results for "'; endif ; ?><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?><span></span><?php if( $term != '' ) : ?><span class="taxonomy-title"><?php echo $term->name; ?></span><?php endif; ?> <span><?php single_cat_title(); ?></span><?php if(is_taxonomy('topic', 'category')) : echo '"'; endif ; ?></h1>
	
	<?php if(is_taxonomy('topic', 'category')) : ?>
	<h2>We've found 		
		<?php printf( __( ' %d %s' ), $wp_query->found_posts, _n( 'result', 'results', $wp_query->found_posts), get_posts() ); ?>.
	</h2>
	<?php endif ; ?>
</div>

<div class="no-margin-bottom">
<ul class="article-list infinitescroll no-bullets">

<?php
/* ============== pull in latest articles (specific to the current taxonomy term/s) ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$current_cat = get_query_var('category_name');
	query_posts( $args );
	$args=array(
	'posts_per_page'=> '-1',
	'post_type'=> 'any',
	'post__not_in' => $do_not_duplicate,
	'paged'=>$paged,
	'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'topic',
            'field' => 'slug',
            'terms' => array('cloud'),
        ),
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('events'),
            'operator' => 'IN',
        ),
		)
);
wp_reset_query();
?>

<?php 
	while ( have_posts() ) : the_post();
	$do_not_duplicate[] = $post->ID ?>
	
	<li class="row article">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php if('event' == get_post_type()) : ?>
		<?php get_template_part("/includes/_event_meta"); ?>
	<?php else : ?>
		<p><?php echo get_excerpt(); ?></p>
		<?php get_template_part("/includes/_article_meta"); ?>
		<!--<p><?php //echo getPostViews(get_the_ID()); ?></p>-->	
	<?php endif ; ?>
	</li>
<?php endwhile; // if have_posts ends 
/* ============== end pull in latest articles ============== */
?>

</ul>
	<?php get_template_part("includes/_pagination"); ?>
</div><!-- /.eight-col -->

<?php /*	<div class="eight-col">
	<?php get_template_part("includes/_pagination"); ?>
	</div><!-- /.eight-col -->

<div class="aside three-col last-col">
	<h2>Filter <span class="lowercase"><?php single_cat_title() ?></span> by topic</h2>
	<ul class="no-bullets">	 
	<li<?php if (!$term) echo ' class="current"'; ?>><a href="/topics/<?php $cat = get_term_by('name', single_cat_title('',false), 'category'); echo $cat->slug; ?>">All <span class="lowercase"><?php single_cat_title() ?></span></a></li>
	<?php 
		$pagecat = $this_category->category_nicename;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$services = get_terms( 'topic', 'hide_empty=1&pad_counts=1');
    $args = array();
    $args['paged'] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    if ( isset( $_GET['service'] ) ) {
        $args['service'] = $_GET['topic'];
        $page_link = add_query_arg( 'topic', $_GET['topic'], $page_link );
    }
    if ( is_array( $services ) ) {
        foreach ( $services as $service ) {
        		if ( $term->slug == $service->slug ) {
        			echo '<li class="current">';
        		} else {
        			echo '<li>';
            }
            	echo '<a href="' . htmlentities( add_query_arg( 'topic', $service->slug, $page_link ) ) . '">' . $service->name . '';
            	//$cat = get_term_by('name', single_cat_title('',false), 'category'); 
            	//echo $cat->slug;
            	echo '</a></li>';
        }
	?>
	<?php } ?>
   </ul>
	
</div> */?>
	
</div><!-- /.row -->

<?php get_footer(); ?>
