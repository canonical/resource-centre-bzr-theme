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

<?php get_template_part("library/includes/_share_links"); ?>
<?php get_template_part("library/includes/_site_nav"); ?>

<footer class="global clearfix" role="contentinfo">
	<div class="legal clearfix">
		<p>&copy; <?php echo date('Y'); ?> Canonical Ltd. Ubuntu and Canonical are registered trademarks of <a href="http://canonical.com">Canonical Ltd</a></p> 
		<ul class="no-bullets inline">
			<li><a class="screen-only container" href="https://bugs.launchpad.net/resource-centre">Report a bug on this site</a></li>
			<li><a href="">Feedback</a></li>
	</div>
</footer>

<?php wp_footer(); ?>

</div><!-- /.site-wrapper -->

</body>
</html>