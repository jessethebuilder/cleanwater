<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="article-content">	
		<blockquote>	
			<?php the_content(); ?>
			<p><cite><?php the_title(); ?></cite></p>
		</blockquote>
	</div>	
</article>