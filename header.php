<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/header.php
 * @since          available since Release 1.0
 */
 $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en" dir="ltr"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en" dir="ltr"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en" dir="ltr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->	

<head>

<!-- Get the Ubuntu font from Google -->
<script>
  WebFontConfig = {
    google: { families: [ 'Ubuntu:300,400,400italic:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>

<title><?php if (is_search()) : ?> <?php echo $search_title; ?> <?php elseif (is_category()) : ?><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?><?php if( $term != '' ) : ?><?php echo $term->name; ?><?php endif; ?> <?php echo strtolower(single_cat_title( '', false, 'right' )); ?><?php if(is_taxonomy('topic', 'category')) : endif ; ?><?php else : ?> <?php wp_title(''); ?><?php endif; ?> <?php if (!is_home()) : ?>|<? endif; ?> <?php bloginfo('name'); ?></title>

<meta charset="utf-8" />
<meta name="description" content="Ubuntu Insights - The Ubuntu resource center" />
<meta name="keywords" content="Ubuntu, Ubuntu operating system, OS, platform, Linux, distribution, OpenStack, Ubuntu OpenStack, Ubuntu Cloud, server, tablet, smartphone, phone, Windows alternative, Mac alternative, free software, open source, thin client, Juju, MAAS, Landscape, Ubuntu Advantage, download Ubuntu, deployment, provisioning, service orchestration, services, commercial support, paid support, long term support, LTS, 14.04, Trusty Tahr, Icehouse, maas" />
<meta name="author" content="Canonical" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- shortcut icons -->
<link rel="shortcut icon" href="//assets.ubuntu.com/sites/ubuntu/latest/u/img/favicon.ico" />
<link rel="apple-touch-icon" href="//assets.ubuntu.com/sites/ubuntu/latest/u/img/touch-icon-iphone.png" />
<link rel="apple-touch-icon" sizes="72x72" href="//assets.ubuntu.com/sites/ubuntu/latest/u/img/touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114" href="//assets.ubuntu.com/sites/ubuntu/latest/u/img/touch-icon-iphone-retina.png" />
<link rel="apple-touch-icon" sizes="144x144" href="//assets.ubuntu.com/sites/ubuntu/latest/u/img/touch-icon-ipad-retina.png" />

<!-- stylesheets -->
<link rel="stylesheet" href="//assets.ubuntu.com/sites/guidelines/css/dev/ubuntu-styles.css" type="text/css" />
<link rel="stylesheet" href="//assets.ubuntu.com/sites/guidelines/css/dev/beta/global.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="stylesheet" media="print" href="<?php bloginfo('template_directory'); ?>/static/css/print.css" type="text/css" />

<?php get_template_part("includes/_feeds"); ?>

<?php wp_head(); ?>

<!-- modernizr -->
<script src="<?php bloginfo('template_directory'); ?>/static/js/plugins/modernizr.2.7.1.js"></script>
	
</head>

<body itemscope itemtype="http://schema.org/Article" id="insights.ubuntu.com" <?php body_class(); ?>>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W3SR7K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W3SR7K');</script>
<!-- End Google Tag Manager -->		

<header id="banner" class="banner global" role="banner">
	<div class="header-inner">
		<span class="accessibility-aid"><a accesskey="s" href="#main-content">Jump to content</a></span>
		<div class="logo">
			<a class="logo-ubuntu" href="<?php echo get_option('home'); ?>/">
				<span><img width="106" height="25" src="//assets.ubuntu.com/sites/ubuntu/latest/u/img/logos/logo-ubuntu-orange.png" alt="<?php bloginfo('name'); ?> logo" /></span>
				<span class="site-name">insights</span>
			</a>
		</div>
		<ul id="nav-triggers" class="inline no-bullets">
			<li><a href="#share" id="share-trigger" class="share-toggle">Share</a></li>
			<li><a href="#box-search" id="search-trigger" class="search-toggle">Search</a></li>
			<li><a href="#main-nav" id="menu" class="nav-toggle">Menu</a></li>
		</ul>
	</div><!-- ./header-inner -->
</header>

<div class="site-wrapper">
<div class="wrapper clearfix">
<div id="main-content" class="inner-wrapper clearfix" role="main">