<?php get_header(); ?>
<div class="col-sm-12 col-md-9 col-md-offset-3 col-lg-7 col-lg-offset-2 col-content">	
	<?php				
		while (have_posts()) : the_post();					
			get_template_part('content', 'page');
			if (comments_open() || get_comments_number()) {
				comments_template();
			}				
		endwhile;
	?>	
</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>				