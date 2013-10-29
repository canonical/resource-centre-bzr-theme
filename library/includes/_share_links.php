<?php
	$post_type = get_post_type_object( get_post_type($post));
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$cat_name = get_category(get_query_var('cat'))->name;
?>
<div id="share">
	<div> 
		<h2>Share 
		<?php if(is_single() ) : ?>this
			<?php if('post' == get_post_type()) : ?>article<?php endif;?>
			<?php if('event' == get_post_type()) : ?>event<?php endif;?>
			<?php if('e-book' == get_post_type()) : ?>e-book<?php endif;?>
			<?php echo $post_type->labels->title_friendly; ?>
		<?php elseif (is_home()) : ?>this website<?php elseif (is_search()) : ?> these search results
		<?php else : ?>this page<?php endif; ?>:
		</h2>
		<ul class="no-bullets">
			<li>
				<a id="share-facebook" class="share" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>">Facebook</a>
			</li>
			<li>
				<a id="share-twitter" class="share" href="http://twitter.com/share?text=<?php if(is_single() ) : ?><?php echo urlencode(the_title()); ?><?php else : ?><?php single_tag_title(); ?><?php endif ; ?>&url=<?php if(is_single() ) : ?><?php echo urlencode( wp_get_shortlink( $post->ID ) ); ?><?php else : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?><?php endif; ?>&hashtags=ubuntu" title="Share on Twitter" rel="nofollow">Twitter</a>
			</li>
			<li>
				<a id="share-googleplus" class="share" href="https://plus.google.com/share?url=<?php urlencode(wp_get_shortlink());?>">Google+</a>
			</li>
			<li>
				<a id="share-email" class="share" title="Share '<?php the_title(); ?>' via Email" href="mailto:?subject=Saw%20this%20and%20thought%20of%20you&amp;body=I've%20just%20read%20'
				<?php if(is_single() ) : ?><?php single_post_title(); ?><?php elseif ( is_home() ) : ?>Ubuntu Resources<?php else : ?><?php single_tag_title(); ?><?php endif; ?>'%20on%20the%20Ubuntu%20resource%20website%20and%20thought%20you%20would%20like%20it.%20Check%20it%20out:%20<?php if ( is_home() ) : ?><?php bloginfo('url'); ?><?php else : ?><?php the_permalink(); ?><?php endif; ?>">Email</a>
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