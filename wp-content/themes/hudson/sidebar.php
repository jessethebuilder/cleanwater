<div id="sidebar" class="col-sm-12 col-md-3 col-lg-2">
	<?php if (get_theme_mod('hudson_logo_setting')): ?>
		<a id="logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="img-responsive" src='<?php echo esc_url(get_theme_mod('hudson_logo_setting')); ?>' alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>'></a>
	<?php else:	?>
		<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>
	<?php endif; ?>	
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<div class="collapse navbar-collapse">
		<?php wp_nav_menu(array('theme_location' => 'primary','depth' => 2,'container_id' => 'primary-menu','container' => 'div','fallback_cb' => 'false')); ?>	
	</div>	
	<?php dynamic_sidebar('primary-sidebar'); ?>
</div>