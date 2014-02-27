<nav role="navigation" class="nav-primary" >
	<div id="main-navigation" class="main-navigation">
			<div id="main-nav">
				<ul class="main-nav no-bullets">
					<li><h2>By topic</h2>
						<ul class="no-bullets">
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary-products', 
							'container' => '' ) ); ?>
						</ul>
					</li>
				</ul>
				<ul class="main-nav no-bullets">
					<li><h2>By content type</h2>
						<ul class="no-bullets">
							<?php wp_nav_menu( array( 
								'theme_location' => 'primary-categories', 
								'container' => '' ) ); ?>
						</ul>
					</li>
				</ul>
			</div><!-- /#main-nav -->
	</div>
	
		<div id="box-search">
			<div>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>	
			</div>
		</div><!-- /#search-box -->
</nav>