<?php
/**
 * bstrap-lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bstrap-lite
 */

if ( ! function_exists( 'bstrap_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bstrap_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bstrap-lite, use a find and replace
	 * to change 'bstrap-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bstrap-lite', get_template_directory() . '/languages' );

	/**
	 * Apply theme's stylesheet to the visual editor.
	 *
	 * @uses add_editor_style() Links a stylesheet to visual editor
	 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
	 */	
	add_editor_style();
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

// Set content width
if ( ! isset( $content_width ) ) $content_width = 712;  
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support('custom-header');
	add_theme_support('custom-logo');

	// Add featured image size, also used for portfolio single page
	add_image_size( 'bstrap-lite-featured-large', 712, 9999 ); // width, height, crop
	//Optional Slider image size https://wordpress.org/plugins/cpt-bootstrap-carousel/
	add_image_size('bstrap-lite-slider', 1062, 350, true);
	add_image_size('post-img', 9999, 350,true);
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'bstrap-lite' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'bstrap-lite' ),	
		'social'  => esc_html__( 'Social Links Menu', 'bstrap-lite' ),
		'second' => esc_html__( 'Second Menu', 'bstrap-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bstrap_lite_custom_background_args', array(
		'default-color' => 'eaeaea',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'bstrap_lite_setup' );

	/**
	* Set the content width in pixels, based on the theme's design and stylesheet.
	*
	* Priority 0 to make it available to lower priority callbacks.
	*
	* @global int $content_width
	*
	* function bstrap_lite_content_width() {
	*	$GLOBALS['content_width'] = apply_filters( 'bstrap_lite_content_width', 640 );
	* }
	* add_action( 'after_setup_theme', 'bstrap_lite_content_width', 0 );
	*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bstrap_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bstrap-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bstrap-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s panel panel-default">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="panel-heading"><h4 class="widget-title panel-title">',
		'after_title'   => '</h4></div><div class="panel-body">',
	) );
		// footer widgets
	register_sidebar(array(
		'name'          => esc_html__( 'Footer 1', 'bstrap-lite' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s panel panel-default">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="panel-heading"><h4 class="widget-title panel-title">',
		'after_title'   => '</h4></div><div class="panel-body">',
	) );
}
add_action( 'widgets_init', 'bstrap_lite_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function bstrap_lite_scripts() {
	
	wp_enqueue_style( 'bstrap-lite-bootstrap-styles', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.2.0', 'all' );	
	wp_enqueue_style( 'bstrap-lite-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0', 'all' );
	
	// Optional bootswatch styles can be loaded here. Load them before the main stylesheet to achieve the theme intended look
	//wp_enqueue_style( 'bstrap-lite-bootswatch-style', get_template_directory_uri() . '/css/BOOTSWATCHSTYLE.css', array(), '1.0.0', 'all' );
	
	wp_enqueue_style( 'bstrap-lite-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'bstrap-lite-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bstrap-lite-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.2.0', true );
	wp_enqueue_script( 'bstrap-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'bstrap-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bstrap_lite_scripts' );

/* вывод количества просмотров */
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count;
}
/* просмотры в админке */
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Просмотров');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}
/* конец вывода просмотров */

/* изменение длины обрезаемого текста поста */
function new_excerpt_length($length) {
	return 60;
}
add_filter('excerpt_length', 'new_excerpt_length');

/* изменение [...] на конце обрезаемого текста  */
add_filter('excerpt_more', function($more) {
	return '...';
});

/* конец изменений обрезаемого текста  */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

	/**
	* Customizer additions.
	*
	*require get_template_directory() . '/inc/customizer.php';
	*/
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**

 * Load Bootstrap Menu.
 */

require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Comments Callback.
 */
require get_template_directory() . '/inc/comments-callback.php';

/**
 * Author Meta.
 */
require get_template_directory() . '/inc/author-meta.php';

/**
 * Search Results - Highlight.
 */
require get_template_directory() . '/inc/search-highlight.php';

/**
 * Breadcrumbs Yum.
 */
require get_template_directory() . '/inc/breadcrumbs.php';
