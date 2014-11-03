<ul class="main-nav topic-nav no-bullets">
	<li class="topics"><a href="#">Topics</a>
        <ul class="second-level-nav">
		<?php wp_nav_menu( array( 
			'theme_location' => 'primary-products', 
			'container' => '' ) ); ?>
		</ul>
	</li>
	<!--<li><a href="">By content type</a>
        <ul class="second-level-nav">
			<?php wp_nav_menu( array( 
				'theme_location' => 'primary-categories', 
				'container' => '' ) ); ?>
		</ul>
	</li>-->
	<li class="press-center"><a href="/press-centre/">Press centre</a>
        <!--<ul class="second-level-nav">
			<?php wp_nav_menu( array( 
				'theme_location' => 'press-centre', 
				'container' => '' ) ); ?>
			<li><a href="/press-centre/#press-contact">Contact</a></li>
		</ul>-->
	</li>
</ul>

<form class="header-search" method="get" action="<?php bloginfo('url'); ?>/">
	<label class="off-left" for="s"><?php _e('Search:'); ?></label>
	<input class="form-text" type="search" autocomplete="off" placeholder="Search" name="s" id="s" />
    <button type="submit"><img src="//assets.ubuntu.com/sites/ubuntu/1218/u/img/search-white.svg" alt="Search" height="28" /></button>
</form>