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
?>
<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en" dir="ltr"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en" dir="ltr"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en" dir="ltr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->	

<head>

<title><?php if (is_search()) : ?> <?php echo $search_title; ?> <?php else : ?> <?php wp_title(''); ?><?php endif; ?> <?php if (!is_home()) : ?>|<? endif; ?> <?php bloginfo('name'); ?></title>

<meta charset="utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" href="touch-icon-iphone.png" />
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone-retina.png" />
<link rel="apple-touch-icon" sizes="144x144" href="touch-icon-ipad-retina.png" />

<!-- Google Chrome Frame for IE -->
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

<link rel="shortcut icon" href="http://assets.ubuntu.com/sites/ubuntu/latest/u/img/favicon.ico" />

<!-- stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400italic" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="stylesheet" media="print" href="/wp-content/themes/resource-centre/library/css/print.css" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" media="screen" href="http://assets.ubuntu.com/sites/ubuntu/534/u/css/global.css" /> -->

<!-- wordpress head functions -->
<?php wp_head(); ?>
<!-- end of wordpress head -->
	
</head>
<!-- body id should be site url, this might change -->	
<body id="resources.ubuntu.com" <?php body_class(); ?>>

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
			<a id="#toggle" class="logo-ubuntu" href="<?php echo get_option('home'); ?>/">
				<span><img width="106" height="25" src="http://assets.ubuntu.com/sites/ubuntu/latest/u/img/logos/logo-ubuntu-orange.png" alt="<?php bloginfo('name'); ?> logo" /></span>
				<span class="site-name">resources</span>
			</a>
		</div>
	</div><!-- ./header-inner -->
</header>

<div class="site-wrapper">

<div class="wrapper clearfix">
<div id="main-content" class="inner-wrapper clearfix" role="main">