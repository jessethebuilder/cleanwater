<?php get_header(); ?>
<div class="col-sm-12 col-md-9 col-md-offset-3 col-lg-7 col-lg-offset-2 col-content">
	<h1><?php _e('Search results:', 'hudson'); echo ' "' . get_search_query() . '"'; ?></h1>
	<?php
		if (have_posts()) :				
			while (have_posts()) : the_post();	
				echo '<div class="article-holder">';				
				get_template_part('content', get_post_format());
				echo '</div>';
			endwhile;
		else :
			get_template_part('content', 'none');
		endif;
	?>
	<?php hudson_pagination(); ?>
</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>	