<?

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Page Template
 *
 *
 * @file           page.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0arrow
 * @since          available since Release 1.0
 */

/* Template Name: Webinars */

get_header(); ?>

<div id="primary" class="site-content">
<div id="content" role="main">

<?php while ( have_posts() ) : the_post(); ?>
<div class="entry-content row no-border">
	<h1><?php the_title(); ?></h1>
	<div class="eight-col">
	<?php the_content(); ?>
	<ul class="webinars-future article-list no-bullets"></ul>
	<ul class="webinars-past article-list no-bullets"></ul>

<script type="text/javascript">

function feed_get(url, num) {
	$.ajax({
		url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=' + num + '&callback=?&q=' + encodeURIComponent(url),
		dataType: 'json',
		success: function(data) {
			feed_render(data.responseData.feed);
		}
	});
}

function feed_render(data) {
	$.each(data.entries, function(index, feed) {
		var feed_date = new Date(feed.publishedDate);
		var today = new Date();
		var pubDate = feed.publishedDate;
		var date = new Date(feed.pubDate);
		var months = Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
		var thedate = date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear()
			
		if (feed_date > today) {
			var item = $('<li class="eight-col"></li>');
			var link = '<h2><a href="' + feed.link + '">' + feed.title + '</a></h2>';
			var text = '<p>' + feed_date.toString().substr(0, 16)  + '</p>';
			var time = '<p class="article-meta">Date:' + pubDate + '</p>';
			
			item.append(link);
			item.append(time);
			item.append(text);
			$('.webinars-future').append(item);

			$('.heading-future').show();
			$('.webinars-future').show();
		} else {
			var item = $('<li class=<?

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Page Template
 *
 *
 * @file           page.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0arrow
 * @since          available since Release 1.0
 */

/* Template Name: Webinars */

get_header(); ?>

<div id="primary" class="site-content">
<div id="content" role="main">

<?php while ( have_posts() ) : the_post(); ?>
<div class="entry-content row no-border">
	<h1><?php the_title(); ?></h1>
	<div class="eight-col">
	<?php the_content(); ?>
	<ul class="webinars-future article-list no-bullets"></ul>
	<ul class="webinars-past article-list no-bullets"></ul>

<script type="text/javascript">

function feed_get(url, num) {
	$.ajax({
		url: 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=' + num + '&callback=?&q=' + encodeURIComponent(url),
		dataType: 'json',
		success: function(data) {
			feed_render(data.responseData.feed);
		}
	});
}

function feed_render(data) {
	$.each(data.entries, function(index, feed) {
		var feed_date = new Date(feed.publishedDate);
		var today = new Date();
		var pubDate = feed.publishedDate;
		var date = new Date(feed.pubDate);
		var months = Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
		var thedate = date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear()
			
		if (feed_date > today) {
			var item = $('<li class="eight-col"></li>');
			var link = '<h2><a href="' + feed.link + '">' + feed.title + '</a></h2>';
			var text = '<p>' + feed_date.toString().substr(0, 16)  + '</p>';
			var time = '<p class="article-meta">Date:' + pubDate + '</p>';
			
			item.append(link);
			item.append(time);
			item.append(text);
			$('.webinars-future').append(item);

			$('.heading-future').show();
			$('.webinars-future').show();
		} else {
			var item = $('<li class="eight-col"></li>');
			var link = '<h3><a href="' + feed.link + '">' + feed.title + '</a></h3>';
			var text = '<p>' + feed.contentSnippet + '</p>' + '<p><a href="' + feed.link + '">Find out more<span class="accessibility-aid"> about ' + feed.title + '</span> &rsaquo;</a></p>';
			var time = '<p class="article-meta"><time>Date:' + thedate + '</time></p>';
			
			item.append(link);
			item.append(time);
			item.append(text);
			$('.webinars-past').append(item);
		}
	});
}

</script>		
	</div><!-- .eight-col -->
	</div><!-- .entry-content -->
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>"eight-col"></li>');
			var link = '<h3><a href="' + feed.link + '">' + feed.title + '</a></h3>';
			var text = '<p>' + feed.contentSnippet + '</p>' + '<p><a href="' + feed.link + '">Find out more<span class="accessibility-aid"> about ' + feed.title + '</span></a></p>';
			var time = '<p class="article-meta"><time>Date:' + thedate + '</time></p>';
			
			item.append(link);
			item.append(time);
			item.append(text);
			$('.webinars-past').append(item);
		}
	});
}

</script>		
	</div><!-- .eight-col -->
	</div><!-- .entry-content -->
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>