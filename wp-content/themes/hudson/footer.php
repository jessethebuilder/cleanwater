</div>	
</div>
<?php if (is_active_sidebar('footer-left-sidebar') || is_active_sidebar('footer-mid-sidebar') || is_active_sidebar('footer-right-sidebar')) : ?>
	<div id="footer-widgets" class="container-fluid">
		<div class="row">		
			<div class="col col-md-3 col-md-offset-3 col-lg-offset-2 col-content">			
				<?php dynamic_sidebar('footer-left-sidebar'); ?>		
			</div>
			<div class="col col-md-3">
				<?php dynamic_sidebar('footer-mid-sidebar'); ?>
			</div>
			<div class="col col-md-3">
				<?php dynamic_sidebar('footer-right-sidebar'); ?>
			</div>			
		</div>
	</div>
<?php endif; ?>
<div id="footer-holder" class="container-fluid">
	<div class="row" >		
		<footer>
			<div class="col-sm-9 col-md-7 col-md-offset-3 col-lg-offset-2 col-content">
				<p id="copyright">&copy; 2014 <?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></p>
				<?php wp_nav_menu(array('theme_location' => 'footer','depth' => 1,'container' => 'false','fallback_cb' => 'false')); ?>
			</div>
			<div class="col-sm-3 col-md-2 col-lg-3">
				<p id="theme"><a id="credit" href="http://www.wpmultiverse.com/themes/hudson/" target="_blank">Hudson Theme</a> 
				<a id="top" href="#top"><span class="glyphicon glyphicon-collapse-up"></span> TOP</a></p>
			</div>
		</footer>		
	</div>
</div>
<?php wp_footer(); ?>   
</body>
</html>