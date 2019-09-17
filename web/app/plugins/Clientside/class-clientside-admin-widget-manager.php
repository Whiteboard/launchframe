<?php
/*
 * Clientside Admin Widget Manager class
 * Contains methods to build the Admin Widget Manager tool and perform the role-based hiding of widgets
 */

class Clientside_Admin_Widget_Manager {

	// Return (array) list of admin widget slugs for a specified page, optionally with a prefix
	static function get_widget_slugs( $page_slug = 'dashboard', $prefix = 'admin-widget-manager-' ) {

		$widgets = self::get_widget_info( $page_slug );
		$widget_slugs = array();

		foreach ( $widgets as $widget_slug => $widget_info ) {
			$widget_slugs[] = $prefix . $widget_slug;
		}

		return $widget_slugs;

	}

	// Return (string) page name to display as option section title
	static function get_page_name( $page_slug = 'dashboard' ) {

		$page_names = array(
			'dashboard' => __( 'Dashboard widgets', 'clientside' ),
			'dashboard-network' => __( 'Network dashboard widgets', 'clientside' ),
			'post-edit-screen' => __( 'Post/page edit screen widgets (metaboxes)', 'clientside' )
		);

		// Return
		return isset( $page_names[ $page_slug ] ) ? $page_names[ $page_slug ] : '';

	}

	// Return (array) all manageble admin widgets' info
	static function get_widget_info( $page = '' ) {

		$widgets = array();

		// Network dashboard (only manageable via the network setting defaults)
		if ( is_network_admin() ) {
			$widgets['dashboard-network'] = array(
				'network_dashboard_right_now' => array(
					'page' => 'dashboard-network',
					'horizontal_position' => 'core',
					'field' => array(
						'name' => 'admin-widget-manager-network_dashboard_right_now',
						'title' => __( 'Right Now' ),
						'secondary-title' => __( 'Enable', 'clientside' ),
						'type' => 'checkbox',
						'default' => 1,
						'role-based' => false
					)
				),
				'clientside-network-dashboard-widget-status' => array(
					'page' => 'dashboard-network',
					'horizontal_position' => 'normal',
					'field' => array(
						'name' => 'admin-widget-manager-clientside-network-dashboard-widget-status',
						'title' => _x( 'Clientside Site and Server Status', 'Admin widget title', 'clientside' ),
						'secondary-title' => __( 'Enable', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => false,
						'default' => 1
					)
				)
			);
		}

		// Dashboard
		$widgets['dashboard'] = array(
			'welcome_panel' => array(
				'page' => 'dashboard',
				'field' => array(
					'name' => 'admin-widget-manager-welcome_panel',
					'title' => _x( 'Welcome to WordPress', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'editor',
						'author',
						'contributor',
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'editor' => 0,
						'author' => 0,
						'contributor' => 0,
						'subscriber' => 0
					)
				)
			),
			'gutenberg_callout' => array(
				'page' => 'dashboard',
				'field' => array(
					'name' => 'admin-widget-manager-gutenberg_callout',
					'title' => _x( '"Try Gutenberg" Callout', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'default' => 1
				)
			),
			'dashboard_browser_nag' => array(
				'page' => 'dashboard',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-dashboard_browser_nag',
					'title' => _x( 'Browser Upgrade Warning', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'default' => 1,
					'role-based' => true
				)
			),
			'dashboard_primary' => array(
				'page' => 'dashboard',
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-dashboard_primary',
					'title' => _x( 'WordPress Events and News', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'default' => 1,
					'role-based' => true
				)
			),
			'dashboard_activity' => array(
				'page' => 'dashboard',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-dashboard_activity',
					'title' => _x( 'Activity', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'default' => 1,
					'role-based' => true
				)
			),
			'dashboard_right_now' => array(
				'page' => 'dashboard',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-dashboard_right_now',
					'title' => _x( 'At a Glance', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'dashboard_quick_press' => array(
				'page' => 'dashboard',
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-dashboard_quick_press',
					'title' => _x( 'Quick Draft', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'clientside-dashboard-widget-status' => array(
				'page' => 'dashboard',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-clientside-dashboard-widget-status',
					'title' => _x( 'Clientside Site and Server Status', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'editor',
						'author',
						'contributor',
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'editor' => 0,
						'author' => 0,
						'contributor' => 0,
						'subscriber' => 0
					)
				)
			)
		);

		// Post/page edit screen
		$widgets['post-edit-screen'] = array(
			'addnew' => array(
				'page' => array( 'post', 'page' ),
				'field' => array(
					'name' => 'admin-widget-manager-addnew',
					'title' => _x( '"Add New" button', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'help' => _x( 'This is not technically a page widget, but close enough to include here.', 'Option description', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'permalink' => array(
				'page' => array( 'post', 'page' ),
				'field' => array(
					'name' => 'admin-widget-manager-permalink',
					'title' => _x( 'Permalink control', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'help' => _x( 'This is not technically a page widget, but close enough to include here.', 'Option description', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'media-button' => array(
				'page' => array( 'post', 'page' ),
				'field' => array(
					'name' => 'admin-widget-manager-media-button',
					'title' => _x( 'Media button', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'help' => _x( 'This is not technically a page widget, but close enough to include here.', 'Option description', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'postexcerpt' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-postexcerpt',
					'title' => _x( 'Excerpt', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'trackbacksdiv' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-trackbacksdiv',
					'title' => _x( 'Send Trackbacks', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'postcustom' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-postcustom',
					'title' => _x( 'Custom Fields', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'commentstatusdiv' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-commentstatusdiv',
					'title' => _x( 'Discussion', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'commentsdiv' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-commentsdiv',
					'title' => _x( 'Comments', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'contributor',
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'editor' => 1,
						'author' => 1,
						'contributor' => 0,
						'subscriber' => 0
					)
				)
			),
			'revisionsdiv' => array(
				'page' => 'post',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-revisionsdiv',
					'title' => _x( 'Revisions', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'authordiv' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-authordiv',
					'title' => _x( 'Author', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'author',
						'contributor',
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'author' => 0,
						'contributor' => 0,
						'subscriber' => 0
					)
				)
			),
			'slugdiv' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-slugdiv',
					'title' => _x( 'Slug', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'formatdiv' => array(
				'page' => 'post',
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-formatdiv',
					'title' => _x( '(Post) Format', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'categorydiv' => array(
				'page' => 'post',
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-categorydiv',
					'title' => _x( 'Categories', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'tagsdiv-post_tag' => array(
				'page' => 'post',
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-tagsdiv-post_tag',
					'title' => _x( 'Tags', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'subscriber' => 0
					)
				)
			),
			'postimagediv' => array(
				'page' => array( 'post', 'page' ),
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-postimagediv',
					'title' => _x( 'Featured Image', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'contributor',
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'contributor' => 0,
						'subscriber' => 0
					)
				)
			),
			'pageparentdiv' => array(
				'page' => 'page',
				'horizontal_position' => 'side',
				'field' => array(
					'name' => 'admin-widget-manager-pageparentdiv',
					'title' => _x( 'Page Attributes', 'Admin widget title', 'clientside' ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'author',
						'contributor',
						'subscriber'
					),
					'default' => array(
						'clientside-default' => 1,
						'author' => 0,
						'contributor' => 0,
						'subscriber' => 0
					)
				)
			)
		);

		// WooCommerce specific
		if ( class_exists( 'WooCommerce' ) ) {
			$widgets['dashboard']['woocommerce_dashboard_status'] = array(
				'page' => 'dashboard',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-woocommerce_dashboard_status',
					'title' => ucwords( __( 'WooCommerce status', 'woocommerce' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'editor',
						'author',
						'contributor',
						'subscriber',
						'customer'
					),
					'default' => array(
						'clientside-default' => 1,
						'editor' => 0,
						'author' => 0,
						'contributor' => 0,
						'subscriber' => 0,
						'customer' => 0
					)
				)
			);
			$widgets['dashboard']['woocommerce_dashboard_recent_reviews'] = array(
				'page' => 'dashboard',
				'horizontal_position' => 'normal',
				'field' => array(
					'name' => 'admin-widget-manager-woocommerce_dashboard_recent_reviews',
					'title' => ucwords( __( 'WooCommerce recent reviews', 'woocommerce' ) ),
					'secondary-title' => __( 'Enable for %s', 'clientside' ),
					'type' => 'checkbox',
					'role-based' => true,
					'disabled-for' => array(
						'editor',
						'author',
						'contributor',
						'subscriber',
						'customer'
					),
					'default' => array(
						'clientside-default' => 1,
						'editor' => 0,
						'author' => 0,
						'contributor' => 0,
						'subscriber' => 0,
						'customer' => 0
					)
				)
			);
			if ( is_network_admin() ) {
				$widgets['dashboard-network']['woocommerce_network_orders'] = array(
					'page' => 'dashboard-network',
					'horizontal_position' => 'normal',
					'field' => array(
						'name' => 'admin-widget-manager-woocommerce_network_orders',
						'title' => ucwords( __( 'WooCommerce network orders', 'woocommerce' ) ),
						'secondary-title' => __( 'Enable', 'clientside' ),
						'type' => 'checkbox',
						'role-based' => false,
						'default' => 1
					)
				);
			}
		}

		// Return
		if ( $page ) {
			return isset( $widgets[ $page ] ) ? $widgets[ $page ] : array();
		}
		return $widgets;

	}

	// Perform the removal of a specific group of widgets
	static function remove_page_widgets( $page = 'dashboard' ) {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-admin-widget-manager-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-admin-widget-manager-tool' ) ) {
			return;
		}

		$widgets = self::get_widget_info( $page );
		foreach ( $widgets as $widget_slug => $widget_info ) {

			// Alternative process
			if ( in_array( $widget_slug, array( 'permalink', 'media-button' ) ) ) {
				continue;
			}

			// Determine wether this widget should be enabled/disabled
			// If this tool is network disabled, use the network defaults
			if ( Clientside_Options::get_saved_network_option( 'disable-admin-widget-manager-tool' ) ) {
				$widget_is_enabled = Clientside_Options::get_saved_network_default_option( 'admin-widget-manager-' . $widget_slug );
			}
			// Use the regular site options
			else {
				$widget_is_enabled = Clientside_Options::get_saved_option( 'admin-widget-manager-' . $widget_slug );
			}

			// If unset (never saved), use the default
			if ( ! is_numeric( $widget_is_enabled ) ) {
				if ( is_array( $widget_info['field']['default'] ) ) {
					$user_role = Clientside_User::get_user_role();
					$user_role = is_null( $user_role ) || ! isset( $widget_info['field']['default'][ $user_role ] ) ? 'clientside-default' : $user_role;
					$widget_is_enabled = $widget_info['field']['default'][ $user_role ];
				}
				else {
					$widget_is_enabled = $widget_info['field']['default'];
				}
			}

			// Remove widget if (role-based) option is set to false - Use network default if multisite && tool is network disabled
			if ( ! $widget_is_enabled ) {
				if ( is_array( $widget_info['page'] ) && isset( $widget_info['horizontal_position'] ) ) {

					// Applying to multiple pages
					foreach ( $widget_info['page'] as $page ) {
						remove_meta_box( $widget_slug, $page, $widget_info['horizontal_position'] );
					}

				}
				else {

					// Welcome panel (special case)
					if ( $widget_slug == 'welcome_panel' ) {
						remove_action( 'welcome_panel', 'wp_welcome_panel' );
					}

					// Gutenberg callout (special case)
					else if ( $widget_slug == 'gutenberg_callout' ) {
						remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
					}

					// Any other widget
					else if ( isset( $widget_info['horizontal_position'] ) ) {
						remove_meta_box( $widget_slug, $widget_info['page'], $widget_info['horizontal_position'] );
					}

				}
			}

		}

	}

	// Apply the removal of widgets/metaboxes where applicable
	static function action_remove_metaboxes() {
		self::remove_page_widgets( 'dashboard' );
		self::remove_page_widgets( 'post-edit-screen' );
		self::remove_page_widgets( 'dashboard-network' );
	}

}
?>
