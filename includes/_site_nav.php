<nav role="navigation" class="nav-primary" >
	<div id="main-navigation" class="main-navigation">
			<div id="main-nav">
				<ul class="main-nav topic-nav no-bullets">
					<li><h2>By topic</h2>
						<ul class="no-bullets">
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary-products', 
							'container' => '' ) ); ?>
						</ul>
					</li>
				</ul>
				<ul class="main-nav type-nav no-bullets">
					<li><h2>By content type</h2>
						<ul class="no-bullets">
							<?php wp_nav_menu( array( 
								'theme_location' => 'primary-categories', 
								'container' => '' ) ); ?>
						</ul>
					</li>
				</ul><?php if (! is_mobile_phone() ) : ?>
				<ul class="main-nav press-nav no-bullets">
					<li><h2>Press centre</h2>
						<ul class="no-bullets">
							<?php wp_nav_menu( array( 
								'theme_location' => 'press-centre', 
								'container' => '' ) ); ?>
							<li><a href="/press-centre/#press-contact">Contact</a></li>
						</ul>
					</li>
				</ul><?php endif; ?>
			</div><!-- /#main-nav -->
	</div><!-- /.#main-navigation -->
	
		<div id="box-search">
			<div>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>	
			</div>
		</div><!-- /#search-box -->
</nav>