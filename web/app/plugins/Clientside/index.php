<?php
/*
Plugin Name: Clientside
Plugin URI: https://frique.me/clientside/
Description: Clientside is a meticulous combination of a redesigned admin theme and a set of settings and tools that help customize and unclutter the WordPress interface for yourself or your clients.
Version: 1.14.5
Author: Berend de Jong
Author URI: https://frique.me/
*/

// Prevent direct access to this file
defined( 'ABSPATH' ) || die();

// Load plugin classes
include( plugin_dir_path( __FILE__ ) . 'inc/php-array-replace-recursive.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-setup.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-options.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-dashboard.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-toolbar.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-pages.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-menu.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-admin-menu-editor.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-admin-widget-manager.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-admin-column-manager.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-custom-cssjs-tool.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-user.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-error-handler.php' );
include( plugin_dir_path( __FILE__ ) . 'class-clientside-updates.php' );

// Plugin setup
add_action( 'admin_enqueue_scripts', array( 'Clientside_Setup', 'action_enqueue_admin_scripts' ) );
add_action( 'login_enqueue_scripts', array( 'Clientside_Setup', 'action_enqueue_login_styles' ) );
add_action( 'login_enqueue_scripts', array( 'Clientside_Setup', 'action_enqueue_login_scripts' ) );
add_filter( 'plugin_action_links', array( 'Clientside_Setup', 'filter_add_plugin_options_link' ), 10, 2 );
add_filter( 'login_body_class', array( 'Clientside_Setup', 'filter_add_body_classes' ) );
add_action( 'login_enqueue_scripts', array( 'Clientside_Setup', 'action_enqueue_login_fonts' ) );
add_action( 'plugins_loaded', array( 'Clientside_Setup', 'action_prepare_translations' ) );
add_action( 'init', 'clientside_init_setup' );
function clientside_init_setup() {
	if ( Clientside::is_enabled() ) {
		add_action( 'admin_enqueue_scripts', array( 'Clientside_Setup', 'action_enqueue_admin_styles' ) );
		add_filter( 'body_class', array( 'Clientside_Setup', 'filter_add_body_classes' ) );
		add_filter( 'admin_body_class', array( 'Clientside_Setup', 'filter_add_body_classes' ), 11 );
		add_action( 'wp_enqueue_scripts', array( 'Clientside_Setup', 'action_dequeue_fonts' ) );
		add_action( 'admin_enqueue_scripts', array( 'Clientside_Setup', 'action_enqueue_admin_fonts' ) );
		add_action( 'admin_init', array( 'Clientside_Setup', 'action_enqueue_editor_styles' ) );
		add_filter( 'all_plugins', array( 'Clientside_Setup', 'filter_trim_plugin_list' ) );
		add_filter( 'post_date_column_time', array( 'Clientside_Setup', 'filter_post_table_date_format' ), 10, 4 );
	}
}

// Register plugin options / settings
add_action( 'admin_init', array( 'Clientside_Options', 'action_register_settings_and_fields' ) );
add_action( 'network_admin_edit_clientside_options', array( 'Clientside_Options', 'action_network_option_save' ) );
add_action( 'admin_init', array( 'Clientside_Options', 'action_import' ) );

// General functionality
add_filter( 'login_headerurl', array( 'Clientside', 'filter_change_login_logo_link' ) );
add_filter( 'login_headertext', array( 'Clientside', 'filter_change_login_logo_title' ) );
add_action( 'login_head', array( 'Clientside', 'action_change_login_logo' ) );
add_filter( 'login_errors', array( 'Clientside', 'filter_login_errors' ) );
add_action( 'init', 'clientside_init_general' );
add_action( 'wp_default_scripts', array( 'Clientside', 'dequeue_jquery_migrate' ) );
function clientside_init_general() {
	if ( Clientside::is_enabled() ) {
		add_filter( 'admin_footer_text', array( 'Clientside', 'filter_footer_text' ) );
		add_filter( 'update_footer', array( 'Clientside', 'filter_footer_version' ), 11 );
		Clientside::action_hide_updates(); // Init action
		Clientside::action_hide_screen_options(); // Init action
		add_action( 'admin_head', array( 'Clientside', 'action_hide_help' ) );
		Clientside::action_remove_version_header(); // Init action
		add_action( 'admin_init', array( 'Clientside', 'action_hide_post_list_date_filter' ) );
		add_action( 'admin_init', array( 'Clientside', 'action_hide_post_list_category_filter' ) );
		add_filter( 'edit_posts_per_page', array( 'Clientside', 'filter_paging_posts' ) );
		add_filter( 'admin_menu', array( 'Clientside', 'action_disable_file_editor' ), 9 );
		add_filter( 'post_row_actions', array( 'Clientside', 'action_disable_quick_edit' ), 10, 2 );
		add_filter( 'page_row_actions', array( 'Clientside', 'action_disable_quick_edit' ), 10, 2 );
		add_filter( 'comment_row_actions', array( 'Clientside', 'action_add_comment_row_actions' ), 10, 2 );
		add_filter( 'plugin_action_links', array( 'Clientside', 'action_add_plugin_row_actions' ), 10, 4 );
		Clientside::dequeue_jquery(); // Init action
		Clientside::dequeue_embed_script(); // Init action
		Clientside::dequeue_emoji_script(); // Init action
	}
}

// Admin widget manipulation
add_action( 'init', 'clientside_init_widgets' );
function clientside_init_widgets() {
	if ( Clientside::is_enabled() ) {
		add_action( 'wp_dashboard_setup', array( 'Clientside_Dashboard', 'action_add_dashboard_widgets' ) );
		add_action( 'wp_network_dashboard_setup', array( 'Clientside_Dashboard', 'action_add_network_dashboard_widgets' ) );
		add_action( 'do_meta_boxes', array( 'Clientside_Admin_Widget_Manager', 'action_remove_metaboxes' ) );
	}
}

// Custom CSS/JS tool
add_action( 'init', 'clientside_init_customcssjs' );
function clientside_init_customcssjs() {
	if ( Clientside::is_themed() ) {
		add_action( 'login_head', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_admin_css_header' ) );
	}
	add_action( 'wp_head', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_site_css_header' ) );
	add_action( 'wp_head', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_site_js_header' ) );
	add_action( 'wp_footer', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_site_js_footer' ) );
	add_action( 'admin_head', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_admin_css_header' ) );
	add_action( 'admin_head', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_admin_js_header' ) );
	add_action( 'in_admin_footer', array( 'Clientside_Custom_CSSJS_Tool', 'action_inject_custom_admin_js_footer' ) );
}

// List Column manipulation
add_action( 'init', 'clientside_init_columns' );
function clientside_init_columns() {
	if ( Clientside::is_enabled() ) {
		add_filter( 'manage_post_posts_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_posts_columns' ), 11 ); // 11 for Yoast columns
		add_filter( 'manage_page_posts_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_pages_columns' ), 11 ); // 11 for Yoast columns
		add_filter( 'manage_users_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_users_columns' ) );
		add_filter( 'manage_media_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_media_columns' ) );
		add_filter( 'manage_product_posts_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_woocommerce_product_columns' ), 11 );
		add_filter( 'manage_shop_order_posts_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_woocommerce_order_columns' ), 11 );
		add_filter( 'manage_shop_coupon_posts_columns', array( 'Clientside_Admin_Column_Manager', 'filter_remove_woocommerce_coupon_columns' ), 11 );
	}
}

// Menu manipulation
//todo admin_init to avoid firing on frontend?
add_action( 'init', array( 'Clientside_Admin_Menu_Editor', 'action_prepare_menu_changes' ) );
add_action( 'admin_menu', array( 'Clientside_Menu', 'action_add_clientside_menu_entries' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) - 1 );
add_action( 'admin_menu', array( 'Clientside_Admin_Menu_Editor', 'action_gather_admin_menu' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) + 1 );
add_filter( 'menu_order', array( 'Clientside_Admin_Menu_Editor', 'filter_apply_custom_menu_order' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) + 2 );
add_action( 'admin_menu', array( 'Clientside_Admin_Menu_Editor', 'action_apply_custom_menu_removal' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) + 3 );
add_action( 'admin_menu', array( 'Clientside_Admin_Menu_Editor', 'action_apply_custom_menu_unremoval' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) + 3 );
add_action( 'admin_menu', array( 'Clientside_Admin_Menu_Editor', 'action_apply_custom_menu_renaming' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) );
add_action( 'save_post', array( 'Clientside_Menu', 'action_reset_posttype_counters' ) );
add_action( 'add_attachment', array( 'Clientside_Menu', 'action_reset_media_counters' ) );
add_action( 'delete_attachment', array( 'Clientside_Menu', 'action_reset_media_counters' ) );
add_action( 'user_register', array( 'Clientside_Menu', 'action_reset_user_counters' ) );
add_action( 'delete_user', array( 'Clientside_Menu', 'action_reset_user_counters' ) );
add_action( 'init', 'clientside_init_menu' );
function clientside_init_menu() {
	if ( Clientside::is_enabled() ) {
		add_filter( 'parent_file', array( 'Clientside_Menu', 'filter_admin_menu_active_states' ) );
		add_filter( 'custom_menu_order', '__return_true' );
		add_action( 'admin_menu', array( 'Clientside_Menu', 'action_add_menu_entries' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) - 1 );
		add_action( ( defined( 'AME_ROOT_DIR' ) ? 'admin_menu' : 'admin_init' ), array( 'Clientside_Menu', 'action_apply_relinks' ), apply_filters( 'clientside-admin-menu-hook-prio', 20000 ) );
		add_action( 'admin_head', array( 'Clientside_Menu', 'action_add_numbers' ) );
		add_action( 'network_admin_menu', array( 'Clientside_Menu', 'action_add_network_menu_entries' ) );
		add_action( 'network_admin_menu', array( 'Clientside_Menu', 'action_add_numbers' ) );
	}
}

// Toolbar manipulation
add_action( 'init', 'clientside_init_toolbar' );
function clientside_init_toolbar() {
	if ( Clientside::is_enabled() ) {
		add_action( 'admin_bar_menu', array( 'Clientside_Toolbar', 'action_add_toolbar_nodes_sooner' ), 0 );
		add_action( 'admin_bar_menu', array( 'Clientside_Toolbar', 'action_add_toolbar_nodes_later' ) );
		add_action( 'admin_bar_menu', array( 'Clientside_Toolbar', 'action_remove_toolbar_nodes' ), 999 );
		Clientside_Toolbar::action_hide_toolbar(); // Init action
		add_action( 'wp_enqueue_scripts', array( 'Clientside_Toolbar', 'action_enqueue_site_toolbar_styles' ) );
		add_filter( 'admin_bar_menu', array( 'Clientside_Toolbar', 'filter_user_greeting' ) );
		Clientside_Toolbar::action_remove_toolbar_css_injection(); // Init action
	}
}

// Process ajax calls
add_action( 'wp_ajax_clientside-get-export', array( 'Clientside_Options', 'get_export' ) );

// Uninstallation hook
register_uninstall_hook( __FILE__, array( 'Clientside_Setup', 'action_uninstall' ) );

// Plugin updates
add_filter( 'pre_set_site_transient_update_plugins', array( 'Clientside_Updates', 'filter_check' ) );
add_filter( 'plugins_api', array( 'Clientside_Updates', 'filter_plugin_info' ), 10, 3 );
add_filter( 'http_request_host_is_external', array( 'Clientside_Updates', 'filter_allow_update_host' ), 10, 3 );
add_filter( 'upgrader_package_options', array( 'Clientside_Updates', 'filter_add_ref_to_download_url' ) );

// Custom error handling
add_action( 'init', 'clientside_init_errors' );
function clientside_init_errors() {
	if ( Clientside::is_enabled() ) {
		Clientside_Error_Handler::action_collect_php_errors(); // Init action
		add_action( 'all_admin_notices', array( 'Clientside_Error_Handler', 'action_output_php_errors' ) );
	}
}

