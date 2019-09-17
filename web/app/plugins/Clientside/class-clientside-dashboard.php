<?php
/*
 * Clientside Dashboard class
 * Contains methods to manipulate the WordPress Admin Dashboard
 */

class Clientside_Dashboard {

	// Add widgets to the Dashboard
	static function action_add_dashboard_widgets() {

		// Site & Server Status widget
		if ( Clientside_User::is_admin() ) {
			wp_add_dashboard_widget(
				'clientside-dashboard-widget-status',
				_x( 'Site and Server Status', 'Dashboard widget title', 'clientside' ),
				array( __CLASS__, 'display_dashboard_status_widget' )
			);
		}

	}

	// Add widgets to the Network dashboard
	static function action_add_network_dashboard_widgets() {

		// Site & Server Status widget
		if ( Clientside_User::is_admin() ) {
			wp_add_dashboard_widget(
				'clientside-network-dashboard-widget-status',
				_x( 'Site and Server Status', 'Dashboard widget title', 'clientside' ),
				array( __CLASS__, 'display_dashboard_status_widget' )
			);
		}

	}

	// Display Site & Server Status dashboard widget
	static function display_dashboard_status_widget() {
		include( plugin_dir_path( __FILE__ ) . 'inc/dashboard-widget-status.php' );
	}

}
?>
