<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="/wp-content/uploads/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/wp-content/uploads/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/wp-content/uploads/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/wp-content/uploads/favicons/apple-touch-icon-76x76.png">
	<link rel="icon" type="image/png" href="/wp-content/uploads/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/wp-content/uploads/favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#2b5797">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<?php wp_head(); ?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/html5shiv.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/respond.min.js"></script>
	<![endif]-->

	<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
	<style>
	.ui-autocomplete-loading {background: url('/img/loading.gif') 99% center no-repeat!important;}
	</style>
    <?php if ( !is_user_logged_in() ){ ?>
    <style>
    #wpadminbar{ display:none; }
    </style>
    <?php } ?>
    <script>
        // clickable banners
        jQuery(document).ready(function(e){
            jQuery("div.topnews-wrapper").click(function() { 
                window.location.href = jQuery(this).find('.topnews-info a').attr('href');
            });
        });
    </script>
</head>
