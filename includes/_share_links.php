<?php
	$post_type = get_post_type_object( get_post_type($post));
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$cat_name = get_category(get_query_var('cat'))->name;
	$category = get_the_category();
	$get_page_name = basename(get_permalink());
	$key = wp_specialchars($s, 1); 
	$search_title = ('Search results for "' . $key . '"');
?>
<div id="share">
	<div> 
		<h2>Share 
		<?php if(is_single() ) : ?>this <?php if('post' == get_post_type()) : ?>article<?php endif;?><?php if('event' == get_post_type()) : ?>event<?php endif;?><?php if('e-book' == get_post_type()) : ?>e-book<?php endif;?><?php echo $post_type->labels->title_friendly; ?><?php elseif (is_home()) : ?>this website<?php elseif (is_search()) : ?> these search results
		<?php else : ?>this page<?php endif; ?>:
		</h2>
		<ul class="no-bullets">
			<li>
				<a id="share-facebook" class="share" href="http://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php if(is_single() ) : ?><?php echo urlencode( the_permalink( $post->ID ) ); ?>&amp;p[title]=<?php echo urlencode(the_title()); ?>&amp;p[summary]=<?php echo urlencode(get_excerpt()); ?>&amp;p%5Bimages%5D%5B0%5D=<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300 ), false, '' ); echo $src[0]; ?><?php elseif(is_home() ): ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>&amp;p[title]=Ubuntu%20Resources%20website&amp;p%5Bimages%5D%5B0%5D=
					<img src='//assets.ubuntu.com/sites/ubuntu/latest/u/img/logos/logo-ubuntu-orange.png' alt='Ubuntu logo' /><?php elseif( is_page() ) : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>&amp;p[title]=Visit%20the%20%27<?php echo basename(get_permalink()); ?>%27%20section%20on%20the%20Ubuntu%20Resources%20website<?php elseif (is_search()) : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>&amp;p[title]=
					Ubuntu%20Resource%20website&amp;p[summary]=I've%20just%20searched%20for%20%27<?php /* Search Count */ $allsearch = &new WP_Query("s$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e(''); echo $key; _e(''); ?>%27%20on%20the%20Ubuntu%20Resources%20website%20and%20thought%20I%20would%20share%20the%20results<?php else : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>&amp;p[title]=Ubuntu%20Resources%20website<?php endif ; ?>">Facebook</a>	
			</li>
			<li>
				<a id="share-twitter" class="share" href="http://twitter.com/share?text= <?php if(is_single() ) : ?> <?php echo urlencode(the_title()); ?> <?php elseif(is_home() ): ?>
					Ubuntu%20Resource%20website <?php elseif( is_page() ) : ?> Visit%20the%20'<?php echo basename(get_permalink()); ?>'%20section%20on%20the%20Ubuntu%20Resources%20website<?php elseif (is_search()) : ?>I've%20just%20searched%20for%20%27<?php /* Search Count */ $allsearch = &new WP_Query("s$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e(''); echo $key; _e(''); ?>%27%20on%20the%20Ubuntu%20Resources%20website%20and%20thought%20I'd%20share%20the%20results.%20Check%20them%20out:<?php else : ?>Ubuntu%20Resource%20website<?php endif ; ?>&amp;url=<?php if(is_single() ) : ?><?php echo urlencode( wp_get_shortlink( $post->ID ) ); ?> <?php else : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?> <?php endif; ?>&amp;hashtags=ubuntu" title="Share on Twitter" rel="nofollow">Twitter</a>
			</li>
			<li><?php // no need for any if else nonse for G+ as it uses the data on the page  ?>
				<a id="share-googleplus" class="share" href="https://plus.google.com/share?url=<?php if(is_single() ) : ?><?php urlencode(the_permalink()); ?><?php else : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?><?php endif; ?>">Google+</a>	
			</li>
			<li>
				<a id="share-email" class="share" title="Share '<?php the_title(); ?>' via Email" href="mailto:?subject=Saw%20this%20and%20thought%20of%20you&amp;body=
				<?php if(is_single() ) : ?>
					I've%20just%20read%20%27<?php single_post_title(); ?>%27%20on%20the%20Ubuntu%20Resources%20website%20and%20thought%20you%20would%20like%20it.%20Check%20it%20out:%20<?php the_permalink(); ?>
				<?php elseif( is_page() ) : ?>
					I've%20just%20visited%20the%20%27<?php echo basename(get_permalink()); ?>%27%20section%20on%20the%20Ubuntu%20Resources%20website%20and%20thought%20you%20would%20like%20it.%20Check%20it%20out:%20<?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>
				<?php elseif(is_home() ): ?>
					I've%20just%20visited%20the%20Ubuntu%20Resources%20website%20and%20thought%20you%20would%20like%20it.%20Check%20it%20out:%20<?php bloginfo('url'); ?>
				<?php elseif (is_search()) : ?>
					I've%20just%20searched%20for%20%27<?php /* Search Count */ $allsearch = &new WP_Query("s$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e(''); echo $key; _e(''); 
	?>%27%20on%20the%20Ubuntu%20Resources%20website%20and%20thought%20I'd%20share%20the%20results%20with%20you.%20Check%20them%20out:%20<?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>
				<?php else : ?>
					I've%20just%20visited%20the%20%27<?php single_tag_title(); ?>%27%20section%20on%20the%20Ubuntu%20Resources%20website%20and%20thought%20you%20would%20like%20it.%20Check%20it%20out:%20<?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>
				<?php endif; ?>">Email</a>
			</li>
		</ul>
	</div>
</div><!-- /#share -->

<!--<script>
// create social networking pop-ups
(function() {
    // link selector and pop-up window size
    var Config = {
        Link: "a.share",
        Width: 500,
        Height: 500
    };
 
    // add handler links
    var slink = document.querySelectorAll(Config.Link);
    for (var a = 0; a < slink.length; a++) {
        slink[a].onclick = PopupHandler;
    }
 
    // create popup
    function PopupHandler(e) {
 
        e = (e ? e : window.event);
        var t = (e.target ? e.target : e.srcElement);
 
        // popup position
        var
            px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
            py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);
 
        // open popup
        var popup = window.open(t.href, "social", 
            "width="+Config.Width+",height="+Config.Height+
            ",left="+px+",top="+py+
            ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
        if (popup) {
            popup.focus();
            if (e.preventDefault) e.preventDefault();
            e.returnValue = false;
        }
 
        return !!popup;
    }
 
}());
</script>-->