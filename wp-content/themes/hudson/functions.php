<?php

// theme setup
if (!function_exists('hudson_setup')):
	function hudson_setup() {	
		register_nav_menus( array(
			'primary' => __('Primary Menu', 'hudson'),	
			'secondary' => __('Secondary Menu', 'hudson'),
			'footer' => __('Footer Menu', 'hudson')	
		));
		add_theme_support('post-thumbnails');
		add_theme_support('post-formats', array('aside','quote'));	
		add_theme_support('automatic-feed-links');	
		add_image_size('featured', 865, 600, true);
		add_image_size('aside', 225, 165, true);
		add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
		// set content width  
		if (!isset($content_width)) {$content_width = 710;}			
	}
endif; 
add_action('after_setup_theme', 'hudson_setup');

// load css 
function hudson_css() {	
	wp_enqueue_style('hudson_roboto', '//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700');	
	wp_enqueue_style('hudson_bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('hudson_zocial', get_template_directory_uri() . '/assets/fonts/zocial.css');	   
	wp_enqueue_style('hudson_style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'hudson_css');

// load javascript
function hudson_javascript() {	
	wp_enqueue_script('hudson_bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.1.1', true); 	
	wp_enqueue_script('hudson_script', get_template_directory_uri() . '/assets/js/hudson.js', array('jquery'), '1.0', true);
	if (is_singular() && comments_open()) {wp_enqueue_script('comment-reply');}
}
add_action('wp_enqueue_scripts', 'hudson_javascript');

// html5 shiv
function hudson_html5_shiv() {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'. get_template_directory_uri() .'/assets/js/html5shiv.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'hudson_html5_shiv');

// widgets
function hudson_widgets_init() {
	register_sidebar(array(
		'name' => __('Sidebar Left', 'hudson'),
		'id' => 'primary-sidebar',
		'description' => __('Widgets in this area will appear in the left sidebar.', 'hudson'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
	register_sidebar(array(
		'name' => __('Sidebar Right', 'hudson'),
		'id' => 'right-sidebar',
		'description' => __('Widgets in this area will appear in the right sidebar.', 'hudson'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
	register_sidebar(array(
		'name' => __('Footer Left', 'hudson'),
		'id' => 'footer-left-sidebar',
		'description' => __('Widgets in this area will appear in the left footer column.', 'hudson'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));	
	register_sidebar(array(
		'name' => __('Footer Middle', 'hudson'),
		'id' => 'footer-mid-sidebar',
		'description' => __('Widgets in this area will appear in the middle footer column.', 'hudson'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));		
	register_sidebar(array(
		'name' => __('Footer Right', 'hudson'),
		'id' => 'footer-right-sidebar',
		'description' => __('Widgets in this area will appear in the right footer column.', 'hudson'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));					
}
add_action('widgets_init', 'hudson_widgets_init');

// page titles
function hudson_title($title, $sep) {
	global $paged, $page;
	if (is_feed()) {return $title;}
	$title .= get_bloginfo('name');	
	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && (is_home() || is_front_page())) {$title = "$title $sep $site_description";}	
	if ( $paged >= 2 || $page >= 2 ) { $title = "$title $sep " . sprintf( __('Page %s', 'hudson'), max($paged, $page));}
	return $title;
}
add_filter('wp_title', 'hudson_title', 10, 2);

// pagination
if (!function_exists('hudson_pagination')):
	function hudson_pagination() {
		global $wp_query;
		$big = 999999999;	
		echo '<div class="page-links">';
		echo paginate_links( array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'prev_next' => False,
		));
		echo '</div>';
	}
endif;

// comments
if (!function_exists('hudson_comment')) :
	function hudson_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		?>	
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"> 	
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-header">	
				<div class="comment-author">						
					<?php echo get_avatar($comment, 40); ?> 
					<p class="comment-author-name"><?php comment_author(); ?><br /><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' - ' . get_comment_time() ?></a></p>
				</div>				
			</div>
			<div class="comment-body">			
				<?php comment_text(); ?>
				<?php if ('0' == $comment->comment_approved) : ?>				
					<p class="comment-awaiting-moderation"><?php _e('Comment is awaiting moderation!', 'hudson'); ?></p>					
				<?php endif; ?>				
			</div>			
		</div>
	<?php 
	}
endif;

// theme customizer
function hudson_customize_register($wp_customize) {
	// logo upload
	$wp_customize->add_section('hudson_logo_section', array(
		'title' => __('Upload Logo', 'hudson'),
		'priority' => 900		
	));
	$wp_customize->add_setting('hudson_logo_setting', array(
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label' => __('Logo', 'hudson'),
		'section' => 'hudson_logo_section',
		'settings' => 'hudson_logo_setting'
	)));	
    // link color
	$wp_customize->add_section('hudson_color_section', array(
		'title' => __('Link Color', 'hudson'),
		'priority' => 901
	));
	$wp_customize->add_setting('hudson_color_setting', array(
	    'default' => '#20b2aa',
	    'sanitize_callback' => 'sanitize_hex_color'	    
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color', array(        
        'section' => 'hudson_color_section',
        'settings' => 'hudson_color_setting'
    )));   
    // social links
    $wp_customize->add_section('hudson_social_section', array(
		'title' => __('Social Links', 'hudson'),
		'priority' => 902				
	));
	$wp_customize->add_setting('hudson_facebook_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('hudson_facebook', array(
		'label' => __('Facebook', 'hudson'),			
		'section' => 'hudson_social_section',
		'settings' => 'hudson_facebook_setting'
	)); 
	$wp_customize->add_setting('hudson_twitter_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('hudson_twitter', array(
		'label' => __('Twitter', 'hudson'),			
		'section' => 'hudson_social_section',
		'settings' => 'hudson_twitter_setting'
	)); 
	$wp_customize->add_setting('hudson_google_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('hudson_google', array(
		'label' => __('Google+', 'hudson'),			
		'section' => 'hudson_social_section',
		'settings' => 'hudson_google_setting'
	));
	$wp_customize->add_setting('hudson_pinterest_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('hudson_pinterest', array(
		'label' => __('Pinterest', 'hudson'),			
		'section' => 'hudson_social_section',
		'settings' => 'hudson_pinterest_setting'
	));
	$wp_customize->add_setting('hudson_linkedin_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('hudson_linkedin', array(
		'label' => __('LinkedIn', 'hudson'),			
		'section' => 'hudson_social_section',
		'settings' => 'hudson_linkedin_setting'
	));
	$wp_customize->add_setting('hudson_rss_setting', array(		
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('hudson_rss', array(
		'label' => __('RSS', 'hudson'),			
		'section' => 'hudson_social_section',
		'settings' => 'hudson_rss_setting'
	));
}
add_action('customize_register', 'hudson_customize_register');

function hudson_custom_css() {
	wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/custom.css');
    $color = get_theme_mod('hudson_color_setting');
    $custom_css = "a, #logo, #primary-menu .sub-menu li a:hover {color:{$color};} a:hover, header .social a:hover i {color:{$color}!important;}";
    wp_add_inline_style('custom-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'hudson_custom_css');

?>