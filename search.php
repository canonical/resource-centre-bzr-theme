<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
$key = wp_specialchars($s, 1); 
$search_title = ('Search results for "' . $key . '"');
include("header.php");
?>
<div class="row no-border">
	<h1>Your search results for "<?php 
		/* Search Count */ 
		global $post;
		if( is_category() ){
			$category = end(get_the_category());
			$current =$category->cat_ID;
			$current_name = $category->cat_name;
		}
		$key = wp_specialchars($s, 1); 
		$count = $wp_query->found_posts; _e('');
		 _e(''); 
		 echo $key; _e(' ');
		 echo strtolower($current_name); 
	?>"
	</h1>
	<h2>We've found 
		<?php echo $wp_query->found_posts; ?>
		<?php echo _n( 'article', 'articles', $count, 'ubuntu-resources' ); ?>.
	</h2>
</div><!-- /.row -->
<div class="no-margin-bottom">

	<?php if (have_posts()) : ?>
	<ul class="article-list infinitescroll no-bullets">
		<?php while (have_posts()) : the_post(); ?>
<?php if ( is_search() ) : ?>
<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-term">\0</strong>', $title); ?>
<?php $excerpt = get_the_excerpt(); $keys= explode(" ",$s); $excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-term">\0</strong>', $excerpt); ?>
<?php endif; ?>				
					<li class="row article"> 
					<h3><a href="<?php the_permalink() ?>"><?php if ( is_search() ) : echo $title; else : echo  the_title(); endif; ?></a></h3>
			<?php if('event' == get_post_type()) : ?>
				<?php get_template_part("/includes/_event_meta"); ?>
			<?php endif; // event ?>
					<?php if(has_post_thumbnail()) : ?>
						<p><?php if ( is_search() ) : echo wp_trim_words($excerpt, 40); else : echo wp_trim_words(the_excerpt(), 40); endif; ?></p>
					<?php else : ?>
						<p><?php if ( is_search() ) : echo wp_trim_words($excerpt , 40); else : echo the_excerpt(), 40; endif; ?></p>
					<?php endif; ?>
						<?php get_template_part("includes/_article_meta"); ?>
											</li>		
					<?php endwhile; ?>
		</ul>
	<?php get_template_part("includes/_pagination"); ?>
</div>
	<?php else : ?>

	<div class="row">
		<h2>No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>
	</div>
	<?php endif; // end have_posts ?>
<!-- <div class="aside three-col last-col">
	
<?php
wp_reset_query();
$taxonomiese[] = array(
	'name'      => 'topic',
	'query_var' => 'topic',
	'heading'   => __( 'Filter by topic' ),
); ?>
<?php foreach ( $taxonomiese as $tax ): ?>
	<?php $current_term = get_query_var( $tax['query_var'] ); ?>
<aside class="search-filter">
<header class="head">
	<h3><?php echo esc_html( $tax['heading'] ); ?></h3>
</header>
<div class="content">
<ul class="blogroll">
	<li>
	<?php if (! isset( $_GET[$tax['query_var']] ) ): ?>
	<strong>All</strong>
	<?php else : ?>
	<a href="<?php echo esc_url( remove_query_arg( $tax['query_var'] ) ) ?>">All</a>
	<?php endif; ?>
	</li>
	<?php foreach( get_terms( $tax['name'] ) as $term ): ?>
	<?php $tax_shortcut = $tax['query_var'] ?>
	<?php $term_shortcut = $term->slug ?>
	<li>
	<?php if ( $current_term == $term->slug ): ?>
	<strong><?php echo esc_html( $term->name ) ?></strong>
	<?php else : ?>
	<a href="<?php echo esc_url( add_query_arg( $tax_shortcut, $term_shortcut ) ) ?>"><?php echo esc_html( $term->name ) ?></a>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
</ul>
</div>
</aside>
<?php endforeach ?>
<?php wp_reset_query(); ?>

<?php
wp_reset_query();
$taxonomies[] = array(
	'name'      => 'category',
	'query_var' => 'cat',
	'heading'   => __( 'Filter by type' ),
); ?>
<?php foreach ( $taxonomies as $tax ): ?>
	<?php $current_term = get_query_var( $tax['query_var'] ); ?>
<aside class="search-filter">
<header class="head">
	<h3><?php echo esc_html( $tax['heading'] ); ?></h3>
</header>
<div class="content">
<ul class="blogroll">
	<li>
	<?php if (! isset( $_GET[$tax['query_var']] ) ): ?>
	<strong>All</strong>
	<?php else : ?>
	<a href="<?php echo esc_url( remove_query_arg( $tax['query_var'] ) ) ?>">All</a>
	<?php endif; ?>
	</li>
	<?php foreach( get_terms( $tax['name'] ) as $term ): ?>
	<?php $tax_shortcut = $tax['query_var'] ?>
	<?php $term_shortcut = $term->term_id ?>
	<li>
	<?php if ( $current_term == $term->slug ): ?>
	<strong><?php echo esc_html( $term->name ) ?></strong>
	<?php else : ?>
	<a href="<?php echo esc_url( add_query_arg( $tax_shortcut, $term_shortcut ) ) ?>"><?php echo esc_html( $term->name ) ?></a>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
</ul>
</div>
</div>
</aside>
<?php endforeach ?>-->
	
<?php get_footer(); ?>
