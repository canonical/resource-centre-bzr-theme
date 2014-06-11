<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php if (have_posts() ) : ?>
<div class="row row-hero cat-page-title no-border">
	<h1 class="inner-wrapper clearfix"><?php wp_title(''); ?></h1>
</div><!-- /.row -->
<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>