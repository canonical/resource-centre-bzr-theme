<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Archive Template
 *
 *
 * @file           archive.php
 * @package        Canonical 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license        license.txt
 * @version        Release: 2.0
 * @filesource     wp-content/themes/canonical/archive.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28archive.php.29
 * @since          available since Release 2.0
 */
?>

<?php get_header(); ?>

<div class="row no-border">
<?php query_posts($query_string . ''); ?>
<div class="eight-col">
<h1>Tag: <?php single_cat_title(); ?></h1>
<p class="content-summary">There are <?php if (is_tag() ) { echo $wp_query->found_posts . ''; } ?> posts filed with the tag '<?php single_cat_title(); ?>'.</p>
	<ul class="article-list no-bullets">
		<?php while (have_posts()) : the_post(); ?>
		<?php if (is_sticky()) continue; ?>
			<?php get_template_part("library/includes/_result_list_item"); ?>		
		<?php endwhile;?>
	</ul>
	
<?php get_template_part("library/includes/_pagination"); ?>

</div><!-- /eight-col -->

<div class="three-col prepend-one last-col">
<?php get_template_part("library/includes/_tags"); ?>
</div><!-- /two-col -->
</div>
<?php get_footer(); ?>
