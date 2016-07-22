<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="article-content clearfix">	
		<?php if (has_post_thumbnail()) { ?>				
			<?php the_post_thumbnail('aside'); ?>		
		<?php } ?>
		<?php
			if (is_single()) :
				the_title('<h1 id="post-title">', '</h1>');					
			else :
				the_title('<h3 class="post-title"><a href="' . esc_url( get_permalink()) . '" rel="bookmark">', '</a></h3>');			    	   
			endif;		
	    ?>	
		<?php the_content(); ?>	
	</div>	
</article>