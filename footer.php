<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Ubuntu theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/ubuntu/footer.php
 * @since          available since Release 1.0
 */
?>

</div><!-- /#main-content -->
</div><!-- /.wrapper -->

<?php get_template_part("includes/_share_links"); ?>
<?php get_template_part("includes/_site_nav"); ?>

<footer class="global clearfix" role="contentinfo">
	<p class="top-link"><a href="#resources.ubuntu.com">Back to the top</a></p>
	<div class="legal clearfix">
		<p>&copy; <?php echo date('Y'); ?> Canonical Ltd. Ubuntu and Canonical are registered trademarks of <a href="http://canonical.com">Canonical Ltd</a></p> 
		<ul class="no-bullets inline">
			<li><a href="http://ubunt.eu/resources-feedback">Feedback</a></li>
			<li><a href="http://www.ubuntu.com/legal">Legal information</a></li>
			<li><a href="http://www.ubuntu.com/privacy-policy">Privacy policy</a></li>
			<li><a class="screen-only" href="https://bugs.launchpad.net/resource-centre">Report a bug on this site</a></li>
		</ul>
	</div>
</footer>

<?php wp_footer(); ?>

<script>
	var isOperaMini = (navigator.userAgent.indexOf('Opera Mini') > -1);
	if(isOperaMini) {
		var root = document.documentElement;
		root.className += " opera-mini";
	}
</script>

<script src="//assets.ubuntu.com/sites/ubuntu/latest/u/js/plugins/yui-min.js"></script>
<script>
	if(!core){ var core = {}; }
	core.globalPrepend = 'body';
</script>
<script src="//assets.ubuntu.com/sites/ubuntu/latest/u/js/core.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/static/js/core.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/static/js/scratch.js"></script>
<script src="//assets.ubuntu.com/sites/ubuntu/latest/u/js/global.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/static/js/plugins/respond.min.js"></script>

</div><!-- /.site-wrapper -->

</body>
</html>