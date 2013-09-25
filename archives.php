<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Archives page Template
 *
 *
 * @file           archives.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 2.0
 * @filesource     wp-content/themes/insights-theme/archives.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28archive.php.29
 * @since          available since Release 2.0
 */

get_header(); 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
?>

<div id="content" role="main" class="row no-border">
	<div class="two-col">
		<?php get_template_part("/library/includes/_nav_archive"); ?>
	</div><!-- /.two-col -->
<?php $postCount = 0; ?>
	<?php if(++$postCount == 1): ?>
	<h1>Archives</h1>
		<div class="eight-col last-col">
			<ul class="article-list no-bullets">
	<?php endif; ?>
            <?php $recent = new WP_Query("showposts=10"); while($recent->have_posts()) : $recent->the_post();?>
			<?php get_template_part("/library/includes/_result_list_item"); ?>		
            <?php endwhile;?>
			</ul>
	</div><!-- end .entry-content -->
</div><!-- #content -->

<?php get_footer(); ?>