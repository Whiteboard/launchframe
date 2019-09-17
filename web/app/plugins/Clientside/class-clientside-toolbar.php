<?php
/*
 * Clientside Toolbar class
 * Contains methods to manipulate the toolbar both in the admin area and while viewing the site
 */

class Clientside_Toolbar {

	// Enqueue site styles
	static function action_enqueue_site_toolbar_styles() {

		// When admin theming is enabled and the toolbar is showing
		if ( is_admin_bar_showing() && Clientside::is_themed() ) {

			// Toolbar styling
			wp_enqueue_style( 'clientside-toolbar-css', plugins_url( 'css/clientside-site-toolbar-1.14.5.min.css', __FILE__ ), array(), null );

			// Additional external plugin support, when applicable
			// Elementor
			if ( defined( 'ELEMENTOR_VERSION' ) ) {
				wp_enqueue_style( 'clientside-plugin-support-css-elementor', plugins_url( 'css/plugin-support/clientside-elementor-1.14.5.min.css', __FILE__ ), array(), null );
			}

		}

	}

	// Add items to the admin toolbar, part 1 (triggered at the earliest priority)
	static function action_add_toolbar_nodes_sooner( $wp_toolbar ) {

		// Only if admin theming is enabled
		if ( ! Clientside::is_themed() ) {
			return;
		}

		// Add menu expand button for when the menu is collapsed
		if ( is_admin() ) {
			$wp_toolbar->add_node(
				array(
					'id' => 'clientside-menu-expand',
					'title' => '<span class="dashicons dashicons-menu"></span>'
				)
			);
		}

		// Add View Site link for when the menu is collapsed
		// Disabled. When reenabling, look at the styling
		/*
		if ( is_admin() ) {
			$wp_toolbar->add_node(
				array(
					'id' => 'clientside-view-site',
					'title' => _x( 'View Site', 'Text on the menu button', 'clientside' ),
					'href' => home_url()
				)
			);
		}
		*/

		// Add Admin link when viewing site (if the user is allowed because a network site that the user doesn't belong to still shows the toolbar)
		if ( ! is_admin() && current_user_can( 'read' ) ) {
			$wp_toolbar->add_node(
				array(
					'id' => 'clientside-admin',
					'title' => Clientside_Options::get_saved_option( 'admin-dashboard-title' ),
					'href' => admin_url()
				)
			);
		}

		// Add full username & role(s)
		if ( Clientside::is_themed() ) {
			$html = '<a href="' . esc_url( admin_url( 'profile.php' ) ) . '">' . Clientside_User::get_full_name() . '</a>';
			$html .= '<span class="clientside-toolbar-user-role">' . Clientside_User::get_user_role_display() . '</span>';
			$wp_toolbar->add_node(
				array(
					'id' => 'clientside-username',
					'title' => $html,
					'parent' => 'user-actions'
				)
			);
		}

	}

	// Add items to the admin toolbar, part 2 (triggered at a later priority)
	static function action_add_toolbar_nodes_later( $wp_toolbar ) {

		// Add notification center (only on backend, not on mobile)
		if ( Clientside_Options::get_saved_option( 'enable-notification-center' ) && is_admin() && ! wp_is_mobile() ) {
			$wp_toolbar->add_node( array(
				'id' => 'clientside-notification-center',
				'title' => '<span class="dashicons dashicons-marker"></span> <span class="clientside-notification-count">0</a>',
				'parent' => 'top-secondary'
			) );
			// Add dummy notification center submenu item
			$wp_toolbar->add_menu( array(
				'id' => 'clientside-notification-center-dummy',
				'parent' => 'clientside-notification-center',
				'title' => ''
			) );
		}

	}

	// Remove items from the admin toolbar (all removed functionality is moved to other places of the interface)
	static function action_remove_toolbar_nodes( $wp_toolbar ) {

		// Remove the WP logo & dropdown menu
		$wp_toolbar->remove_node( 'wp-logo' );

		// Remove the Updates item
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-updates' ) ) {
			$wp_toolbar->remove_node( 'updates' );
		}

		// Remove the Comments button
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-comments' ) ) {
			$wp_toolbar->remove_node( 'comments' );
		}

		// Remove the View Posts (archive view) button
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-view-posts' ) ) {
			$wp_toolbar->remove_node( 'archive' );
		}

		// Remove the New button & dropdown menu
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-new' ) ) {
			$wp_toolbar->remove_node( 'new-content' );
		}

		// Remove the front-end toolbar search
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-search' ) ) {
			$wp_toolbar->remove_node( 'search' );
		}

		// Remove the Customize button
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-customize' ) ) {
			$wp_toolbar->remove_node( 'customize' );
		}

		// Remove the "My Sites" dropdown (multisite)
		if ( Clientside_Options::get_saved_option( 'hide-toolbar-mysites' ) ) {
			$wp_toolbar->remove_node( 'my-sites' );
		}

		// Only continue if admin theming is enabled
		if ( ! Clientside::is_themed() ) {
			return;
		}

		// Remove the Site name & dropdown menu
		$wp_toolbar->remove_node( 'site-name' );

		// Remove User menu parts that are added differently
		if ( Clientside::is_themed() ) {
			$wp_toolbar->remove_node( 'user-info' );
		}
		$wp_toolbar->remove_node( 'edit-profile' );

	}

	// Determine wether to show or hide the admin toolbar depending on page & option
	static function action_hide_toolbar() {

		// Only if viewing the site
		if ( is_admin() ) {
			return;
		}

		// Option value for current role
		if ( Clientside_Options::get_saved_option( 'hide-front-admin-toolbar' ) ) {
			show_admin_bar( false );
		}

	}

	// Remove injected CSS on front-end site to add margin-top for admin toolbar (Does not remove admin toolbar)
	static function action_remove_toolbar_css_injection() {

		// Only when theming is enabled
		if ( Clientside::is_themed() ) {
			add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
		}

	}

	// Remove "Howdy, [username]" text
	static function filter_user_greeting( $wp_toolbar ) {

		// Get current state
		$node = $wp_toolbar->get_node('my-account');
		$user = wp_get_current_user();

		// Remove username and get a higher resolution avatar if theming is enabled
		if ( Clientside::is_themed() ) {
			$new_title = get_avatar( get_current_user_id(), '42' );
		}

		// If theming is disabled, do remove howdy & replace display name with full name
		if ( ! Clientside::is_themed() ) {
			$full_name = Clientside_User::get_full_name( $user );
			$new_title = str_replace( 'Howdy, ', '', $node->title );
			$new_title = str_replace( $user->display_name, $full_name, $new_title );
		}

		// Apply new text
		$wp_toolbar->add_node(
			array(
				'id' => 'my-account',
				'title' => $new_title
			)
		);

	}

}
?>
