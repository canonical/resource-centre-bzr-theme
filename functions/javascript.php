<?php
/*
	Contents:
		add jquery
		add google plus and marketo for single only (atm)
		add facebook social gubbin's
		add ie conditional html5 shim to header
		add infinite Scroll and masonry
		add author javascript
		add google analytics
		add marketo to footer
*/

// add jquery
function jquery_init() {
	if (!is_admin() && is_search() || is_category()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/static/js/jquery.min.js', false, '1.9.1', true);
		wp_enqueue_script('jquery');

    	// load infinite scroll jquery
		wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/static/js/jquery.infinitescroll.min.js', array('jquery'),null,true );

    	// load manual-trigger.js jquery
		wp_register_script( 'infinite_scroll_trigger',  get_template_directory_uri() . '/static/js/manual-trigger.js', array('jquery'),null,true );
		    if( ! is_singular() ) {
		        wp_enqueue_script('infinite_scroll');
		        wp_enqueue_script('infinite_scroll_trigger');
		        //wp_enqueue_script('jquery_masonry');
		    }
	}
}
add_action('wp_footer', 'jquery_init');
// end add jquery

// add google analytics to footer
function add_google_analytics() {
	if (!is_admin()) { ?>
        <!-- google analytics -->
				<script>
				var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-1018242-39']);
				_gaq.push(['_trackPageview']);
				(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; 
				
				ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
				
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
				</script>
    <?php
    }
}
add_action('wp_footer', 'add_google_analytics');
// end add google analytics to footer

// add munchkin to footer
function add_munchkin_tracking() {
	if (!is_admin()) { ?>
<!-- marketo -->
    <script>
			(function() {
			  function initMunchkin() {
			    Munchkin.init('066-EOV-335',  {cookieAnon: false});
			  }
			  var s = document.createElement('script');
			  s.type = 'text/javascript';
			  s.async = true;
			  s.src = document.location.protocol + '//munchkin.marketo.net/munchkin.js';
			  s.onreadystatechange = function() {
			    if (this.readyState == 'complete' || this.readyState == 'loaded') {
			      initMunchkin();
			    }
			  };
			  s.onload = initMunchkin;
			  document.getElementsByTagName('body')[0].appendChild(s);
			})();
		</script>

    <?php
    }
}
add_action('wp_footer', 'add_munchkin_tracking');
// end add munchkin to footer
?>
