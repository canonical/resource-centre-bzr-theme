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
 * @version        Release: 1.0
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
	<h2 class="heading-future">Future webinars</h2>
	<ul class="webinars-future article-list no-bullets"></ul>
	<h2 class="heading-past">Past webinars</h2>
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
	$.each(data.entries, function(index, entry) {
		var feed_date = new Date(entry.pubDate);
		var today = new Date();
		var date = entry.publishedDate; 
		var mydate = new Date(date)
		var months = Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
 
		var thedate = mydate.getDate() + ' ' + months[mydate.getMonth()] + ' ' + mydate.getFullYear();

		if (feed_date > today) {
			var item = $('<li class="eight-col"></li>');
			var link = '<h3><a href="' + entry.link + '">' + entry.title + '</a></h3>';
			var text = '<p>' + entry.contentSnippet + '</p>' + '<p><a href="' + entry.link + '">Find out more<span class="accessibility-aid"> about ' + entry.title + '</span> &rsaquo;</a></p>';
			var time = '<p class="article-meta">' + thedate + '</p>';
			
			item.append(link);
			item.append(time);
			item.append(text);
			$('.webinars-future').append(item);
			$('.heading-future').show();
			$('.webinars-future').show();
		} else {
			var item = $('<li class="eight-col"></li>');
			var link = '<h3><a href="' + entry.link + '">' + entry.title + '</a></h3>';
			var text = '<p>' + entry.contentSnippet + '</p>' + '<p><a href="' + entry.link + '">Find out more<span class="accessibility-aid"> about ' + entry.title + '</span> &rsaquo;</a></p>';
			var time = '<p class="article-meta"><time>' + thedate + '</time></p>';
			
			item.append(link);
			item.append(time);
			item.append(text);
			$('.webinars-past').append(item);
			$('.heading-past').show();
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