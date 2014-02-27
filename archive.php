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

get_header(); 
$count = 0; 
?>

<div class="row no-border">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php $count++; ?>
	<?php if ( $count == 1 ): ?>
		<?php
			if ( is_post_type_archive() ) :
		    ?>
		    <h1>
		    		<?php 
	  					$post_type = get_post_type_object( get_post_type($post) );
							echo $post_type->labels->plural_name; 
						?>
				</h1>
		<?php
			elseif(is_tax('audience')):
		?>
		    <h1><?php single_cat_title(); ?></h1>
		    <?php
			else :
		?>			
				<div class="two-col">
					<?php get_template_part("/includes/_nav_archive"); ?>
				</div><!-- /.two-col -->
				<h1>Posts from <?php the_time(' F Y') ?></h1>
		    <?php
			endif;
		?>			
		<?php endif; ?>
		
		<?php
			if ( is_post_type_archive() || is_tax('audience') ) :
		    ?>
	<? if($count == 1): ?><div class="twelve-col">
			<ul id="article-list" class="no-bullets"><? endif; ?>
			<li class="result <? if($count == 1): ?> featured-article box twelve-col<? else: ?> eight-col<? endif; ?><? if($count == 4): ?> last-col<? endif; ?>">
		    <?php
			else :
		?>			
	<? if($count == 1): ?><div class="eight-col">
			<ul class="article-list no-bullets"><? endif; ?>
			<li class="result">
		    <?php
			endif;
		?>			
			<?php get_template_part("/includes/_result_list_item"); ?>		
			</li>	
	<?php endwhile; ?>
	<?php endif; // end have_posts ?>
			</ul>
	</div><!-- /.twelve-col -->
</div>
<?php get_footer(); ?>
