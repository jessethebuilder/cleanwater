<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>" />           
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="profile" href="http://gmpg.org/xfn/11" />        
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />  
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container-fluid">
	<div class="row">
	<?php get_sidebar('primary-sidebar'); ?>	
	<?php $location = 'secondary'; ?>
	<div id="header-holder">
		<?php if (has_nav_menu($location)||(get_theme_mod('hudson_facebook_setting'))||(get_theme_mod('hudson_twitter_setting'))||(get_theme_mod('hudson_google_setting'))||(get_theme_mod('hudson_pinterest_setting'))||(get_theme_mod('hudson_linkedin_setting'))||(get_theme_mod('hudson_rss_setting'))) : ?>
			<header class="clearfix">
				<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 col-lg-7 col-lg-offset-2 col-content">
					<?php wp_nav_menu(array('theme_location' => 'secondary','depth' => 1,'container' => false,'fallback_cb' => false)); ?>							
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 social">	
					<?php if (get_theme_mod('hudson_facebook_setting')): ?><a href="<?php echo get_theme_mod('hudson_facebook_setting'); ?>" target="_blank"><i class="zocial icon facebook"></i></a><?php endif; ?>					
					<?php if (get_theme_mod('hudson_twitter_setting')): ?><a href="<?php echo get_theme_mod('hudson_twitter_setting'); ?>" target="_blank"><i class="zocial icon twitter"></i></a><?php endif; ?>
					<?php if (get_theme_mod('hudson_google_setting')): ?><a href="<?php echo get_theme_mod('hudson_google_setting'); ?>" target="_blank"><i class="zocial icon googleplus"></i></a><?php endif; ?>
					<?php if (get_theme_mod('hudson_pinterest_setting')): ?><a href="<?php echo get_theme_mod('hudson_pinterest_setting'); ?>" target="_blank"><i class="zocial icon pinterest"></i></a><?php endif; ?>
					<?php if (get_theme_mod('hudson_linkedin_setting')): ?><a href="<?php echo get_theme_mod('hudson_linkedin_setting'); ?>" target="_blank"><i class="zocial icon linkedin"></i></a><?php endif; ?>
					<?php if (get_theme_mod('hudson_rss_setting')): ?><a href="<?php echo get_theme_mod('hudson_rss_setting'); ?>" target="_blank"><i class="zocial icon rss"></i></a><?php endif; ?>		
				</div>
			</header>
		<?php endif; ?>
	</div>