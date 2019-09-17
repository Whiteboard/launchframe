<?php
/*
 * Clientside Setup class
 * Contains functions to integrate itself into the WordPress installation
 */

class Clientside_Setup {

	static $editor_font_family = 'Lato:400,400:i';
	static $admin_font_family = 'Lato:400,400:i';

	// Enqueue admin stylesheets
	static function action_enqueue_admin_styles() {

		// Always-use CSS
		wp_enqueue_style( 'clientside-admin-css', plugins_url( 'css/clientside-admin-1.14.5.css', __FILE__ ), array(), null );

		// Enqueue the media manager scripts and styles (only when on the Clientside general options page)
		$screen = get_current_screen();
		if ( in_array( $screen->id, array(
			'appearance_page_clientside-options-general',
			'themes_page_clientside-options-network-site-defaults-network'
		) ) ) {
			wp_enqueue_media();
		}

		// When admin theming is enabled...
		if ( Clientside::is_themed() ) {

			// Theme CSS
			wp_enqueue_style( 'clientside-theme-css', plugins_url( 'css/clientside-admin-theme-1.14.5.min.css', __FILE__ ), array( 'clientside-admin-css', 'thickbox' ), null );

			// Gutenberg
			// if ( defined( 'GUTENBERG_VERSION' ) ) {
				wp_enqueue_style( 'clientside-plugin-support-css-gutenberg', plugins_url( 'css/plugin-support/clientside-gutenberg-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
			// }

			// Additional external plugin support, when applicable
			if ( Clientside_Options::get_saved_option( 'enable-plugin-support' ) ) {

				// Global
				wp_enqueue_style( 'clientside-plugin-support-css', plugins_url( 'css/clientside-plugin-support-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );

				// Visual Composer
				if ( defined( 'WPB_VC_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-vc', plugins_url( 'css/plugin-support/clientside-vc-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// bbPress
				if ( class_exists( 'bbPress' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-bbpress', plugins_url( 'css/plugin-support/clientside-bbpress-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Advanced Custom Fields (free + pro)
				if ( class_exists( 'acf' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-acf', plugins_url( 'css/plugin-support/clientside-acf-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// WooCommerce
				if ( class_exists( 'WooCommerce' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-woocommerce', plugins_url( 'css/plugin-support/clientside-woocommerce-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// WPML
				if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-wpml', plugins_url( 'css/plugin-support/clientside-wpml-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Formidable Forms
				if ( function_exists( 'load_formidable_forms' ) ) {

					wp_enqueue_style( 'clientside-plugin-support-css-formidable', plugins_url( 'css/plugin-support/clientside-formidable-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );

					// Dequeue unconventional table styling
					$screen = get_current_screen();
					if ( $screen && $screen->id == 'toplevel_page_formidable' && isset( $_GET['page'] ) && $_GET['page'] == 'formidable' && ! isset( $_GET['frm_action'] ) ) {
						wp_dequeue_style( 'formidable-admin' );
					}

				}

				// Layers WP
				if ( defined( 'LAYERS_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-layerswp', plugins_url( 'css/plugin-support/clientside-layerswp-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Jetpack
				if ( defined( 'JETPACK__VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-jetpack', plugins_url( 'css/plugin-support/clientside-jetpack-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Google Analytics Dashboard
				if ( defined( 'GADWP_CURRENT_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-gadash', plugins_url( 'css/plugin-support/clientside-gadash-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// HTML Editor Syntax Highlighter
				if ( defined( 'HESH_LIBS' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-htmleditorsyntax', plugins_url( 'css/plugin-support/clientside-htmleditorsyntax-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// WP Statistics
				if ( defined( 'WP_STATISTICS_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-wpstatistics', plugins_url( 'css/plugin-support/clientside-wpstatistics-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Revolution Slider
				if ( defined( 'REVSLIDER_TEXTDOMAIN' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-revslider', plugins_url( 'css/plugin-support/clientside-revslider-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Divi (builder & theme)
				if ( defined( 'ET_BUILDER_PLUGIN_VERSION' ) || function_exists( 'et_get_theme_version' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-divi', plugins_url( 'css/plugin-support/clientside-divi-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Super Forms
				if ( class_exists( 'SUPER_Forms' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-superforms', plugins_url( 'css/plugin-support/clientside-superforms-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Elementor
				if ( defined( 'ELEMENTOR_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-elementor', plugins_url( 'css/plugin-support/clientside-elementor-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Enhanced Media Library
				if ( function_exists( 'wpuxss_get_eml_slug' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-eml', plugins_url( 'css/plugin-support/clientside-eml-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Admin Menu Tree Page View
				if ( defined( 'admin_menu_tree_page_view_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-adminmenutreepageview', plugins_url( 'css/plugin-support/clientside-adminmenutreepageview-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// W3 Total Cache
				if ( defined( 'W3TC' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-w3tc', plugins_url( 'css/plugin-support/clientside-w3tc-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// BuddyPress
				if ( class_exists( 'BuddyPress' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-buddypress', plugins_url( 'css/plugin-support/clientside-buddypress-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// WP All Import
				if ( defined( 'WP_ALL_IMPORT_PREFIX' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-wpallimport', plugins_url( 'css/plugin-support/clientside-wpallimport-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// LearnDash
				if ( defined( 'LEARNDASH_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-learndash', plugins_url( 'css/plugin-support/clientside-learndash-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// WooCommerce Advanced Bulk Edit (https://wpmelon.com)
				if ( class_exists( 'W3ExAdvancedBulkEditMain' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-advbulkedit', plugins_url( 'css/plugin-support/clientside-advbulkedit-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Calendarize it! / Options panel
				if ( defined( 'RHC_VERSION' ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-calendarizeit', plugins_url( 'css/plugin-support/clientside-calendarizeit-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

				// Enfold theme
				//- get_option( 'stylesheet' ) == 'enfold' // Does not work when using a child theme of Enfold.
				global $avia_config;
				if ( isset( $avia_config ) && ! empty( $avia_config ) ) {
					wp_enqueue_style( 'clientside-plugin-support-css-enfold', plugins_url( 'css/plugin-support/clientside-enfold-1.14.5.min.css', __FILE__ ), array( 'clientside-theme-css' ), null );
				}

			}

		}

	}

	// Enqueue admin scripts
	static function action_enqueue_admin_scripts() {

		// Gather conditional dependencies
		$dependencies = array(
			'jquery',
			'thickbox',
			'jquery-ui-sortable' //todo Only on menu editor tool
		);

		// Clientside theme JS
		wp_enqueue_script( 'clientside-admin-js', plugins_url( 'js/clientside-admin.js', __FILE__ ), $dependencies, '1.14.5' );

		// Add localized strings
		wp_localize_script( 'clientside-admin-js', 'clientside', array(
			'L10n' => array(
				// Source: navMenuL10n
				'saveAlert' => __( 'The changes you made will be lost if you navigate away from this page.' ),
				'untitled' => _x( '(no label)', 'missing menu item navigation label' ),
				// Custom:
				'backToTop' => _x( 'Back to top', 'Title attribute for the Back to top button.', 'clientside' ),
				'revertConfirm' => _x( 'Are you sure you want to remove all customizations and start from scratch?', 'Confirmation message when reverting the Admin Menu Editor to default.', 'clientside' ),
				'screenOptions' => __( 'Screen Options' ),
				'help' => __( 'Help' ),
				'exportLoading' => __( 'Loading...', 'clientside' )
			),
			// Non-translation variables
			'options_slug' => Clientside_Options::$options_slug,
			'isMobile' => wp_is_mobile() ? 1 : '',
			'themeEnabled' => Clientside::is_themed() ? 1 : '',
			'clientsideEnabled' => Clientside::is_enabled() ? 1 : '',
			'tableRowCollapse' => Clientside_Options::get_saved_option( 'post-table-collapse' ) ? 1 : '',
			'metaboxCloseEnabled' => Clientside_Options::get_saved_option( 'enable-metabox-close-button' ) ? 1 : ''
		) );

	}

	// Enqueue login/register page stylesheet
	static function action_enqueue_login_styles() {

		// Only if login page theming is enabled
		if ( Clientside::is_themed() ) {
			wp_enqueue_style( 'clientside-login-css', plugins_url( 'css/clientside-login-1.14.5.min.css', __FILE__ ), array(), null );
		}

	}

	// Enqueue login/register page scripts
	static function action_enqueue_login_scripts() {

		// Only if login page theming is enabled
		if ( Clientside::is_themed() ) {
			wp_enqueue_script( 'clientside-login-js', plugins_url( 'js/clientside-login.js', __FILE__ ), array( 'jquery' ), '1.14.5' );
		}

	}

	// Enqueue text editor CSS
	static function action_enqueue_editor_styles() {

		// Only if the option is enabled
		if ( ! Clientside_Options::get_saved_option( 'enable-editor-styling' ) ) {
			return;
		}

		// Load the stylesheet
		add_editor_style( plugins_url( 'css/clientside-editor-1.14.5.min.css', __FILE__ ) );

		// Load the Google Fonts, unless Google Fonts are disabled
		if ( ! Clientside_Options::get_saved_option( 'disable-google-fonts-admin' ) ) {
			add_editor_style( str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=' . self::$editor_font_family ) );
		}

	}

	// Deactivate the default Google Fonts version of Open Sans while viewing the site
	static function action_dequeue_fonts() {

		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );

	}

	// Dequeue and enqueue Google Fonts in the admin area
	static function action_enqueue_admin_fonts() {

		// Deactivate the default Google Fonts version of Open Sans
		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );

		// Replace them, unless Google Fonts are disabled
		if ( ! Clientside_Options::get_saved_option( 'disable-google-fonts-admin' ) ) {
			wp_enqueue_style( 'clientside-admin-fonts', 'https://fonts.googleapis.com/css?family=' . self::$admin_font_family );
		}

	}

	// Enqueue Google Fonts fonts for the login screen
	static function action_enqueue_login_fonts() {
		wp_enqueue_style( 'clientside-login-fonts', 'https://fonts.googleapis.com/css?family=' . self::$admin_font_family );
	}

	// Add plugin options link to the plugin entry in the plugin list
	static function filter_add_plugin_options_link( $links, $file ) {

		// Check that this is the right plugin entry
		$plugin_base_file = dirname( plugin_basename( __FILE__ ) ) . '/index.php';
		if ( $file != $plugin_base_file ) {
			return $links;
		}

		// Check that this user is allowed to manage the settings
		if ( ! Clientside_User::is_admin() ) {
			return $links;
		}

		// Generate link
		$settings_link = '<a href="' . Clientside_Pages::get_page_url( 'clientside-options-general' ) . '">' . __( 'Settings' ) . '</a>';

		// Add to links array
		array_unshift( $links, $settings_link );

		// Return links array
		return $links;

	}

	// Add CSS classes to the page's <body> tag
	static function filter_add_body_classes( $body_classes ) {

		$new_classes = array();

		// Only when logged in
		if ( ! is_user_logged_in() ) {
			return $body_classes;
		}

		// If viewing the site
		if ( ! is_admin() ) {
			$new_classes[] = 'clientside-site';
		}

		// If non-mobile (.mobile is added by default)
		if ( ! wp_is_mobile() ) {
			$new_classes[] = 'not-mobile';
		}

		// If theming is enabled
		if ( Clientside::is_themed() ) {
			$new_classes[] = 'clientside-theme';
		}

		// Selected admin menu theme
		$new_classes[] = 'clientside-menu-theme--' . Clientside_Options::get_saved_option( 'theme-menu' );

		// If posts-per-page is overwritten via the option
		if ( Clientside_Options::get_saved_option( 'paging-posts' ) ) {
			$new_classes[] = 'clientside-custom-paging';
		}

		// If hide-top-paging option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-top-paging' ) ) {
			$new_classes[] = 'clientside-hide-top-paging';
		}

		// If hide-post-search option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-post-search' ) ) {
			$new_classes[] = 'clientside-hide-post-search';
		}

		// If hide-top-bulk option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-top-bulk' ) ) {
			$new_classes[] = 'clientside-hide-top-bulk';
		}

		// If hide-user-role-changer
		if ( Clientside_Options::get_saved_option( 'hide-user-role-changer' ) ) {
			$new_classes[] = 'clientside-hide-user-role-changer';
		}

		// If hide-view-switch option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-view-switch' ) ) {
			$new_classes[] = 'clientside-hide-view-switch';
		}

		// If hide-media-bulk-select option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-media-bulk-select' ) ) {
			$new_classes[] = 'clientside-hide-media-bulk-select';
		}

		// If hide-post-list-date-filter option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-post-list-date-filter' ) ) {
			$new_classes[] = 'clientside-hide-date-filter';
		}

		// If hide-comment-type-filter option is enabled
		if ( Clientside_Options::get_saved_option( 'hide-comment-type-filter' ) ) {
			$new_classes[] = 'clientside-hide-comment-type-filter';
		}

		// If enable-separators option is enabled
		if ( ! is_network_admin() && Clientside_Options::get_saved_option( 'enable-separators' ) ) {
			$new_classes[] = 'clientside-show-menu-separators';
		}
		if ( is_network_admin() && Clientside_Options::get_saved_network_option( 'enable-separators-network' ) ) {
			$new_classes[] = 'clientside-show-menu-separators';
		}

		// If menu-hover-expand option is enabled (now used for popout bubbles)
		if ( Clientside_Options::get_saved_option( 'menu-hover-expand' ) && is_admin() ) {
			$new_classes[] = 'clientside-menu-hover-expand';
		}
		else {
			$new_classes[] = 'clientside-inline-submenus';
		}

		// If enable-notification-center option is enabled
		if ( Clientside_Options::get_saved_option( 'enable-notification-center' ) && ! wp_is_mobile() ) {
			$new_classes[] = 'clientside-notification-center';
		}

		// If post edit addnew option is disabled
		if ( ! Clientside_Options::get_saved_option( 'admin-widget-manager-addnew' ) ) {
			$new_classes[] = 'clientside-hide-postedit-addnew';
		}

		// If post edit permalink option is disabled
		if ( ! Clientside_Options::get_saved_option( 'admin-widget-manager-permalink' ) ) {
			$new_classes[] = 'clientside-hide-permalink';
		}

		// If post edit media-button option is disabled
		if ( ! Clientside_Options::get_saved_option( 'admin-widget-manager-media-button' ) ) {
			$new_classes[] = 'clientside-hide-media-button';
		}

		// Post-table-collapse option
		if ( Clientside_Options::get_saved_option( 'post-table-collapse' ) ) {
			$new_classes[] = 'clientside-post-table-collapse';
		}

		// Menu counters option
		if ( Clientside_Options::get_saved_option( 'enable-menu-counters' ) ) {
			$new_classes[] = 'clientside-show-menu-counters';
		}

		// Menu default collapse option
		if ( Clientside_Options::get_saved_option( 'menu-always-collapsed' ) ) {
			$new_classes[] = 'clientside-menu-collapsed-default';
		}
		else {
			$new_classes[] = 'clientside-menu-not-collapsed-default';
		}

		// Add role-specific classes
		if ( is_admin() ) {
			$all_roles = Clientside_User::get_all_roles( true );
			$user_roles = Clientside_User::get_user_role( 0, 'multiple' );
			foreach ( $all_roles as $role_slug => $role_details ) {
				if ( in_array( $role_slug, $user_roles ) ) {
					$new_classes[] = 'role-' . $role_slug;
				}
				else {
					$new_classes[] = 'not-role-' . $role_slug;
				}
			}
		}

		// Merge & return
		if ( is_array( $body_classes ) ) {
			return array_merge( $body_classes, $new_classes );
		}
		return $body_classes . ' ' . implode( ' ', $new_classes ) . ' ';

	}

	// Remove plugin settings when uninstalling Clientside
	static function action_uninstall() {
		delete_option( Clientside_Options::$options_slug );
		delete_option( Clientside_Options::$network_default_options_slug );
	}

	// Tells WP where to find language files
	static function action_prepare_translations() {
		load_plugin_textdomain( 'clientside', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	// Hide Clientside from plugin list depending on network option
	static function filter_trim_plugin_list( $plugins ) {

		if ( is_multisite() && ! is_super_admin() && Clientside_Options::get_saved_network_option( 'hide-plugin-entry' ) ) {
			unset( $plugins['Clientside/index.php'] );
		}

		// Return
		return $plugins;

	}

	// Make sure post table date columns have a <abbr> tag for styling and appear in date format from settings
	static function filter_post_table_date_format( $t_time, $post, $column_name = '', $mode = '' ) {

		// If the date format is the default Y/m/d, change it to the date format from the WP settings (not if it's in "1 minute ago" format)
		$t_time = is_numeric( strpos( $t_time, '/' ) ) ? get_the_date() : $t_time;

		// Post table in excerpt mode should have <abbr>
		if ( Clientside_Options::get_saved_option( 'post-table-collapse' ) ) {
			if ( $mode === 'excerpt' ) {
				$t_time = '<abbr title="' . $t_time . '">' . $t_time . '</abbr>';
			}
		}

		// Return
		return $t_time;

	}

}
?>
