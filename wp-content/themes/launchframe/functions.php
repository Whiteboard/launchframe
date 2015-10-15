<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

require get_template_directory() . '/inc/version.php';
global $package_version;

class LaunchframeSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action('wp_enqueue_scripts', array( $this, 'lf_cleanup'));
    add_action( 'wp_enqueue_scripts', array( $this, 'register_stylesheets' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		parent::__construct();
	}


  function lf_cleanup() {
    wp_deregister_script('jquery');
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
  }

  function register_stylesheets() {
    global $package_version;
    //wp_enqueue_style( 'application', get_template_directory_uri() . '/assets/dist/css/application.css', false, $package_version );
    if (!is_home() && !is_front_page()){
      wp_enqueue_style( 'application', get_template_directory_uri() . '/assets/dist/css/application.min.css', false, $package_version );
    }
  }
  function register_scripts() {
    //wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js', false, $package_version, true );
    //wp_enqueue_script( 'application', get_template_directory_uri() . '/assets/dist/js/script.js', array('jquery', 'plugins'), $package_version, true );
  }

	function register_post_types() {
		//this is where you can register custom post types

	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new LaunchframeSite();

