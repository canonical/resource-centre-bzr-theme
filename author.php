<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Author Template
 *
 *
 * @file           author.php
 * @package        Ubuntu blog theme
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/author.php
 * @link           http://codex.wordpress.org/Author_Templates
 * @since          available since Release 1.0
 */
?>

<?php get_header(); ?>
<?php if ( is_author('') ) { ?>
<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>

<div class="row no-border">
<div class="seven-col">
    <div id="hcard-<?php echo $curauth->first_name; ?>-<?php echo $curauth->last_name; ?>" class="vcard">
	    <div class="two-col">
    <!--<?php if(get_the_author_meta('user_photo', $curauth->ID)): ?>
	    <img src="<?php bloginfo('url'); ?>/wp-content/uploads/<?php echo $curauth->user_photo; ?>" alt="<?php echo $curauth->first_name; ?>'s photo" class="avatar avatar-140 photo" width="140" height="140" />
    <?php else : ?>
	    	<?php echo get_avatar($curauth->user_email, '140', $avatar); ?>
    <?php endif; ?> -->
	    </div>
	    <div id="author-info" class="five-col last-col">
	    	<header>
		    		<h1><?php echo $curauth->display_name; ?></h1>
		    	<?php if(get_the_author_meta('user_job_title',$curauth->ID)){ ?>
					<p class="role"><?php echo $curauth->user_job_title; ?></p>
				<?php } ?>
	    		<?php if(get_the_author_meta('location',$curauth->ID)){ ?>
					<p class="location"><?php echo $curauth->location; ?></p>
				<?php } ?>
	    	</header>
				<ul id="social-links" class="no-bullets">
					<li><a class="social-rss url" href="/author/<?php the_author_meta('user_nicename',$curauth->ID); ?>/feed/" title="Subscribe to <?php the_author_meta('first_name',$curauth->ID); ?>'s RSS feed">Subscribe to <?php the_author_meta('first_name',$curauth->ID); ?>'s RSS feed</a></li>
				<?php if(get_the_author_meta('user_twitter', $curauth->ID)): ?>
					<li><a class="social-twitter url" href="http://twitter.com/<?php the_author_meta('user_twitter', $curauth->ID); ?>" title="Follow <?php the_author_meta('first_name', $curauth->ID); ?> on Twitter">Follow <?php the_author_meta('first_name',$curauth->ID); ?> on Twitter</a></li>
				<?php endif; ?>
				<?php if(get_the_author_meta('user_facebook', $curauth->ID)): ?>
					<li><a class="social-facebook url" href="http://facebook.com/<?php the_author_meta('user_facebook', $curauth->ID); ?>" title="Follow <?php the_author_meta('first_name',$curauth->ID); ?> on Facebook">Follow <?php the_author_meta('first_name',$curauth->ID); ?> on Facebook</a></li>
				<?php endif; ?>
				<?php if(get_the_author_meta('user_google', $curauth->ID)): ?>
					<li><a title="Follow <?php the_author_meta('first_name',$curauth->ID); ?> on Google Plus" class="social-google url" href="https://plus.google.com/<?php the_author_meta('user_google',$curauth->ID); ?>">Follow <?php the_author_meta('first_name',$curauth->ID); ?> on Google Plus</a></li>
				<?php endif; ?>
				<?php if(get_the_author_meta('user_launchpad', $curauth->ID)): ?>
					<li><a class="social-launchpad url" href="https://launchpad.net/~<?php echo $curauth->user_launchpad; ?>" title="View <?php echo $curauth->first_name; ?> on Launchpad">Launchpad</a></li>
				<?php endif; ?>
				</ul>
<?php if(get_the_author_meta('user_description', $curauth->ID)) : ?>
<div id="author-description" class="">
	<?php echo $curauth->user_description; ?>
</div><!-- /#author-description -->
<?php endif; // user_description ?>
	    </div><!-- /.seven-col -->
    </div><!-- /.vcard -->
</div><!-- /.twelve-col -->  

<div class="five-col last-col">
	<aside>
	<?php $postCount = 0; ?>	
		<div id="author-articles" class="">
		<h3>Recently posted by <?php if(get_the_author_meta('first_name', $curauth->ID)): ?><?php echo $curauth->first_name; ?><?php else : ?><?php echo $curauth->display_name; ?><?php endif; ?></h3>
			<?php $loop = new WP_Query( array( 'post_type' => $post_types, 'author' => $curauth->ID, 'posts_per_page' => 5 ) ); ?>
			<?php if ( $loop->have_posts() ) : ?>
				<ul class="no-bullets">
		<?php while ( $loop->have_posts() ) : ?>
		<?php $loop->the_post(); ?>
			        <li class="block-click<?php the_category_unlinked(' post-'); ?>">
			        	<article>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<p><span class="off-left">Posted on </span><time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j') ?><?php the_time(' F Y') ?></time></p>
							<p class="post-category">Posted in: <?php the_category_unlinked(); ?></p>
			        	</article>
			        </li>
		<?php endwhile; ?>
					    </ul>
		<?php else: ?>
			        <p><?php _e('No posts by this author.'); ?></p>
		<?php endif; // have_posts() ?>
		</div><!-- /#articles -->
	<?php } ?>
	</aside>
</div><!-- /.five-col --> 
  
</div><!-- /.twelve-col -->

<?#php get_sidebar(); ?>
<?php get_footer(); ?>