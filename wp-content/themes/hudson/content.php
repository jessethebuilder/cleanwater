<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail('featured'); ?>
	<div class="article-content">		
		<?php			
			if (is_single()) :
				the_title('<h1 id="post-title">', '</h1>');
				echo '<p class="post-date-author"><span class="glyphicon glyphicon-calendar"></span>'. get_the_date() .'<span class="glyphicon glyphicon-user"></span>'. get_the_author() .'</p><hr/>';	
				the_content();
				wp_link_pages('before=<div id="paged-post">&after=</div>');			
			else :	    				
				the_title('<h3 class="post-title"><a href="' . esc_url( get_permalink()) . '" rel="bookmark">', '</a></h3>');										
				echo '<p class="post-date-author"><span class="glyphicon glyphicon-calendar"></span>'. get_the_date() .'<span class="glyphicon glyphicon-user"></span>'. get_the_author() .'</p><hr/>';
				if ($post->post_excerpt) :
		        	the_excerpt();
		        	echo '<a class="excerpt-link" href="'. esc_url( get_permalink()) .'">Continue Reading <span>&rarr;</span> </a>';
		    	else :	
		    		the_content('Continue Reading <span>&rarr;</span>');	
		    	endif;		    	
			endif;						
	    ?>	
		<?php 
			$posttags = get_the_tags();
			if ($posttags) {
				echo '<p class="post-tags clearfix">';
			    foreach($posttags as $tag) {
			    	echo '<a href="' . get_tag_link( $tag->term_id ) . '">#' . $tag->name.'</a>'; 					    	
			  	}	
			  	echo '</p>';				  	
			} 
		?>		
	</div>
	<div class="post-meta">	
		<?php if (is_sticky()) : ?>	
			<p class="sticky-txt"><span class="glyphicon glyphicon-star"></span> Featured Post</p>
		<?php endif; ?>    	  	
    	<p>
    		<span class="glyphicon glyphicon-folder-open"></span>
    		<?php
				$categories = get_the_category();
				$separator = ' / ';
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= $category->cat_name.$separator;
					}
					echo trim($output, $separator);
				}
			?>
    	</p>
    	<p><span class="glyphicon glyphicon-comment"></span><?php comments_number(); ?></p>	    	
    </div>    
</article>
<?php if (is_single()) : ?>	
	<div id="post-nav">				
		<?php
			$prev_post = get_previous_post();
			if (!empty($prev_post)): ?>			
			<div id="post-nav-prev">
				<span class="glyphicon glyphicon-chevron-left"></span> 
				<a class="post-nav-older" href="<?php echo get_permalink($prev_post->ID); ?>">
					<?php echo get_the_title($prev_post); ?>
				</a>
			</div>
		<?php endif; ?>			
		<?php
			$next_post = get_next_post();
			if (!empty($next_post)): ?>
			<div id="post-nav-next">
				<a href="<?php echo get_permalink($next_post->ID); ?>">										
					<?php echo get_the_title($next_post); ?>				
				</a>
				<span class="glyphicon glyphicon-chevron-right"></span>
			</div>
		<?php endif; ?>
	</div>	
<?php endif; ?>	