<?php
/*
 * Clientside Pages class
 * Contains methods and information concerning all plugin pages
 */

class Clientside_Pages {

	// Return (array) the properties of all Clientside admin pages
	static function get_pages( $page_slug = '' ) {

		$pages = array();

		// Default page properties
		$default_args = array(
			'menu-title' => '',
			'tab-title' => '',
			'parent' => 'themes.php',
			'in-menu' => false,
			'has-tab' => true,
			'tab-side' => false,
			'network' => false
		);

		$pages['clientside-options-general'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-options-general',
				'menu-title' => _x( 'Admin Theme', 'Page title in the menu', 'clientside' ),
				'tab-title' => _x( 'Plugin Options', 'Option tab title', 'clientside' ),
				'title' => _x( 'Clientside Admin Theme Options', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_general_options_page' ),
				'in-menu' => true
			)
		);

		$pages['clientside-options-network'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-options-network',
				'menu-title' => _x( 'Admin Theme', 'Page title in the menu', 'clientside' ),
				'title' => _x( 'Clientside Admin Theme Network Options', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_network_options_page' ),
				'in-menu' => true,
				'has-tab' => true,
				'network' => true
			)
		);

		$pages['clientside-options-network-site-defaults'] = array_merge(
			$default_args,
			array(
				'slug' => 'clientside-options-network-site-defaults',
				'title' => _x( 'Network Site Option Defaults', 'Option page title', 'clientside' ),
				'callback' => array( __CLASS__, 'display_network_options_site_defaults_page' ),
				'network' => true
			)
		);

		//if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-widget-manager-tool' ) ) {
			$pages['clientside-options-network-widget-defaults'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-options-network-widget-defaults',
					'title' => _x( 'Admin Widget Manager Defaults', 'Option page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_network_options_widget_defaults_page' ),
					'network' => true
				)
			);
		//}

		//if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-column-manager-tool' ) ) {
			$pages['clientside-options-network-column-defaults'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-options-network-column-defaults',
					'title' => _x( 'Admin Column Manager Defaults', 'Option page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_network_options_column_defaults_page' ),
					'network' => true
				)
			);
		//}

		//if ( ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$pages['clientside-options-network-cssjs-defaults'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-options-network-cssjs-defaults',
					'title' => _x( 'Custom CSS/JS Tool Defaults', 'Option page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_network_options_cssjs_defaults_page' ),
					'network' => true
				)
			);
		//}

		if (
			! Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) ||
			! Clientside_Options::get_saved_network_option( 'disable-admin-widget-manager-tool' ) ||
			! Clientside_Options::get_saved_network_option( 'disable-admin-column-manager-tool' ) ||
			! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' )
			) {
			$pages['clientside-tools'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-tools',
					'title' => _x( 'Admin Tools', 'Option page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_tools_page' )
				)
			);
		}

		if ( ! Clientside_Options::get_saved_network_option( 'network-hide-importexport' ) ) {
			$pages['clientside-importexport'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-importexport',
					'title' => _x( 'Import/Export Settings', 'Option page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_importexport_page' )
				)
			);
		}

		if ( ! Clientside_Options::get_saved_network_option( 'network-hide-documentation' ) ) {
			$pages['clientside-documentation'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-documentation',
					'title' => _x( 'Documentation & Support', 'Option page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_documentation_page' )
				)
			);
		}

		if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) && Clientside_Options::get_saved_option( 'enable-admin-menu-editor-tool' ) ) {
			$pages['clientside-admin-menu-editor'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-admin-menu-editor',
					'title' => _x( 'Admin Menu Editor', 'Tool page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_admin_menu_editor' ),
					'parent' => 'tools.php',
					'in-menu' => true,
					'has-tab' => false
				)
			);
		}

		if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-widget-manager-tool' ) && Clientside_Options::get_saved_option( 'enable-admin-widget-manager-tool' ) ) {
			$pages['clientside-admin-widget-manager'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-admin-widget-manager',
					'title' => _x( 'Admin Widget Manager', 'Tool page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_admin_widget_manager' ),
					'parent' => 'tools.php',
					'in-menu' => true,
					'has-tab' => false
				)
			);
		}

		if ( ! Clientside_Options::get_saved_network_option( 'disable-admin-column-manager-tool' ) && Clientside_Options::get_saved_option( 'enable-admin-column-manager-tool' ) ) {
			$pages['clientside-admin-column-manager'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-admin-column-manager',
					'title' => _x( 'Admin Column Manager', 'Tool page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_admin_column_manager' ),
					'parent' => 'tools.php',
					'in-menu' => true,
					'has-tab' => false
				)
			);
		}

		if ( ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) && Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) ) {
			$pages['clientside-custom-cssjs-tool'] = array_merge(
				$default_args,
				array(
					'slug' => 'clientside-custom-cssjs-tool',
					'title' => _x( 'Custom CSS/JS', 'Tool page title', 'clientside' ),
					'callback' => array( __CLASS__, 'display_custom_cssjs_tool' ),
					'parent' => 'tools.php',
					'in-menu' => true,
					'has-tab' => false
				)
			);
		}

		// Return
		if ( $page_slug ) {
			if ( ! isset( $pages[ $page_slug ] ) ) {
				return null;
			}
			return $pages[ $page_slug ];
		}
		return $pages;

	}

	// Output the content of the requested options page
	static function display_general_options_page() {
		$page_info = self::get_pages( 'clientside-options-general' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-general.php' );
	}

	// Output the content of the requested options page
	static function display_network_options_page() {
		$page_info = self::get_pages( 'clientside-options-network' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-network.php' );
	}

	// Output the content of the requested options page
	static function display_network_options_site_defaults_page() {
		$page_info = self::get_pages( 'clientside-options-network-site-defaults' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-network-site-defaults.php' );
	}

	// Output the content of the requested options page
	static function display_network_options_widget_defaults_page() {
		$page_info = self::get_pages( 'clientside-options-network-widget-defaults' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-network-site-defaults.php' );
	}

	// Output the content of the requested options page
	static function display_network_options_column_defaults_page() {
		$page_info = self::get_pages( 'clientside-options-network-column-defaults' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-network-site-defaults.php' );
	}

	// Output the content of the requested options page
	static function display_network_options_cssjs_defaults_page() {
		$page_info = self::get_pages( 'clientside-options-network-cssjs-defaults' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-options-network-site-defaults.php' );
	}

	// Output the content of the documentation page
	static function display_documentation_page() {
		$page_info = self::get_pages( 'clientside-documentation' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-documentation.php' );
	}

	// Output the content of the Clientside Tools page
	static function display_tools_page() {
		$page_info = self::get_pages( 'clientside-tools' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-tools.php' );
	}

	// Output the content of the Clientside Import/export Settings page
	static function display_importexport_page() {
		$page_info = self::get_pages( 'clientside-importexport' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-importexport.php' );
	}

	// Output the content of the admin menu editor tool page
	static function display_admin_menu_editor() {
		$page_info = self::get_pages( 'clientside-admin-menu-editor' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-admin-menu-editor.php' );
	}

	// Output the content of the admin widget manager tool page
	static function display_admin_widget_manager() {
		$page_info = self::get_pages( 'clientside-admin-widget-manager' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-admin-widget-manager.php' );
	}

	// Output the content of the admin column manager tool page
	static function display_admin_column_manager() {
		$page_info = self::get_pages( 'clientside-admin-column-manager' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-admin-column-manager.php' );
	}

	// Output the content of the custom css/js tool page
	static function display_custom_cssjs_tool() {
		$page_info = self::get_pages( 'clientside-custom-cssjs-tool' );
		include( plugin_dir_path( __FILE__ ) . 'inc/page-custom-cssjs-tool.php' );
	}

	// Output the HTML for page tabs on the Clientside pages
	static function show_page_tabs( $active_page = '', $multisite = false ) {

		$tabs_html = '<h2 class="nav-tab-wrapper">';
		$tab_count = 0;
		foreach ( self::get_pages() as $page_info ) {

			if ( ! $page_info['has-tab'] ) {
				continue;
			}

			if ( ( $page_info['network'] && ! $multisite ) || ( ! $page_info['network'] && $multisite ) ) {
				continue;
			}

			$url = self::get_page_url( $page_info['slug'] );
			$tabs_html .= '<a class="nav-tab ' . ( $page_info['slug'] == $active_page ? 'nav-tab-active ' : '' ) . ( $page_info['tab-side'] ? 'nav-tab-side ' : '' ) . '" href="' . $url . '">';
			$tabs_html .= $page_info['tab-title'] ? $page_info['tab-title'] : $page_info['title'];
			$tabs_html .= '</a> '; // Has trailing space to match native tabs

			$tab_count++;

		}
		$tabs_html .= '</h2>';

		// Only output if more than 1 tabs are visible
		if ( $tab_count > 1 ) {
			echo $tabs_html;
		}

	}

	// Return URL to specific page
	static function get_page_url( $page_slug = '', $params = array() ) {

		// Get page info
		$page_info = self::get_pages( $page_slug );
		if ( is_null( $page_info ) ) {
			return '';
		}

		// Format page params
		$querystring = '';
		if ( count( $params ) ) {
			foreach ( $params as $key => $value ) {
				$querystring .= '&' . $key . '=' . $value;
			}
		}

		// Network page
		if ( $page_info['network'] ) {
			$url = network_admin_url( $page_info['parent'] . '?page=' . $page_info['slug'] . $querystring );
		}

		// Regular page
		else {
			$url = admin_url( $page_info['parent'] . '?page=' . $page_info['slug'] . $querystring );
		}

		// Return
		return $url;

	}

}
?>
