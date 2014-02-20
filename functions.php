<?php
/**
 * launchframe functions and definitions
 *
 * @package launchframe
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

require_once('env.php');
function dev_env(){
	global $devenv;
	return $devenv == true;
}

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'launchframe_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */

function launchframe_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'launchframe' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'launchframe', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'launchframe' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'launchframe_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // launchframe_setup
add_action( 'after_setup_theme', 'launchframe_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function launchframe_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'launchframe' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'launchframe_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function launchframe_scripts() {
	// Theme definition
	wp_enqueue_style( 'launchframe-style', get_stylesheet_uri() );

	if (dev_env()){
		wp_enqueue_style( 'launchframe-style-custom', get_template_directory_uri() . "/assets/dist/css/wb-bootstrap.css"  );
		wp_enqueue_script( 'buildjs', get_template_directory_uri() . '/assets/dist/js/wb-bootstrap.js', array( 'jquery' ), '201301.1', true );
	} else {
		wp_enqueue_style( 'launchframe-style-custom', get_template_directory_uri() . "/assets/dist/css/wb-bootstrap.min.css"  );
		wp_enqueue_script( 'buildjs', get_template_directory_uri() . '/assets/dist/js/wb-bootstrap.min.js', array( 'jquery' ), '201301.2', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'launchframe_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
