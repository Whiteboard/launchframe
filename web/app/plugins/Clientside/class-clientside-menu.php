<?php
/*
 * Clientside Menu class
 * Contains methods to manipulate the admin sidebar menu
 */

class Clientside_Menu {

	// Add plugin admin pages
	static function action_add_clientside_menu_entries() {

		// Clientside pages
		foreach ( Clientside_Pages::get_pages() as $page_info ) {

			if ( $page_info['network'] ) {
				continue;
			}

			$page_info['menu-title'] = $page_info['menu-title'] ? $page_info['menu-title'] : $page_info['title'];

			if ( ! $page_info['in-menu'] ) {
				$page_info['menu-title'] = '';
			}

			add_submenu_page(
				$page_info['parent'],
				$page_info['title'],
				$page_info['menu-title'],
				Clientside_User::get_admin_cap(),
				$page_info['slug'],
				$page_info['callback']
			);

		}

	}

	// Add various menu items
	static function action_add_menu_entries() {

		$menu_logo_image = Clientside_Options::get_saved_option( 'menu-logo-image' );
		$hide_menu_logo = Clientside_Options::get_saved_option( 'hide-menu-logo' );
		$always_show_view_site = Clientside_Options::get_saved_option( 'always-show-view-site' );

		// Add custom sidebar menu collapse button to the bottom
		add_menu_page(
			__( 'Collapse menu' ),
			__( 'Collapse menu' ),
			'read',
			'clientside-menu-collapse',
			'__return_false',
			'dashicons-menu',
			999
		);

		// Add a custom logo image to the top
		if ( ! $hide_menu_logo && $menu_logo_image ) {
			add_menu_page(
				_x( 'Logo image', 'Menu button description', 'clientside' ),
				'<img class="clientside-menu-logo" src="' . esc_attr( $menu_logo_image ) . '" title="' . get_bloginfo( 'name' ) . '">',
				'read',
				'clientside-view-site-logo',
				'__return_false',
				'none',
				0
			);
		}

		// Add a View Site button to the top
		if ( $hide_menu_logo || ! $menu_logo_image || $always_show_view_site ) {
			add_menu_page(
				_x( 'View Site', 'Text on the menu button', 'clientside' ),
				_x( 'View Site', 'Text on the menu button', 'clientside' ),
				'read',
				'clientside-view-site',
				'__return_false',
				'none',
				0
			);
		}

	}

	// Convert certain keywords to external links
	static function action_apply_relinks() {

		global $menu;
		if ( $menu && is_array( $menu ) && ! empty( $menu ) ) {
			foreach ( $menu as $menuitem_key => $menuitem ) {

				// Collapse menu button
				if ( isset( $menuitem[2] ) && $menuitem[2] == 'clientside-menu-collapse' ) {
					$menu[ $menuitem_key ][2] = '#';
				}

				// View Site button
				if ( isset( $menuitem[2] ) && $menuitem[2] == 'clientside-view-site' ) {
					$menu[ $menuitem_key ][2] = apply_filters( 'clientside-view-site-button-url', home_url() );
				}

				// Menu logo
				if ( isset( $menuitem[2] ) && $menuitem[2] == 'clientside-view-site-logo' ) {
					$menu[ $menuitem_key ][2] = apply_filters( 'clientside-view-site-logo-url', home_url() );
				}

			}
		}

	}

	// Add network admin pages & menu items
	static function action_add_network_menu_entries() {

		// Clientside pages
		foreach ( Clientside_Pages::get_pages() as $page_info ) {

			if ( ! $page_info['network'] ) {
				continue;
			}

			if ( ! $page_info['in-menu'] ) {
				$page_info['parent'] = null;
			}

			add_submenu_page(
				$page_info['parent'],
				$page_info['title'],
				( $page_info['menu-title'] ? $page_info['menu-title'] : $page_info['title'] ),
				Clientside_User::get_admin_cap(),
				$page_info['slug'],
				$page_info['callback']
			);

		}

	}

	// Highlight the proper menu item for tabbed Clientside pages
	static function filter_admin_menu_active_states( $parent_file ) {

		global $submenu_file;
		$screen = get_current_screen();
		$general_options_page = Clientside_Pages::get_pages( 'clientside-options-general' );

		// Highlight the default Clientside menu item for each hidden options page
		foreach ( Clientside_Pages::get_pages() as $page_info ) {
			if ( $page_info['in-menu'] ) {
				continue;
			}
			if ( is_numeric( strpos( $screen->base, $page_info['slug'] ) ) ) {
				$parent_file = $general_options_page['parent'];
				$submenu_file = $general_options_page['slug'];
				break;
			}
		}

		// Return
		return $parent_file;

	}

	// Remove Updates page from the admin menu
	static function action_remove_update_menu() {
		remove_submenu_page( 'index.php', 'update-core.php' );
	}

	// Add numbers behind certain menu items
	static function action_add_numbers() {

		// Only if admin theming is enabled
		if ( ! Clientside::is_themed() ) {
			return;
		}

		// Only if menu counters are enabled
		if ( ! Clientside_Options::get_saved_option( 'enable-menu-counters' ) ) {
			return;
		}

		global $menu;
		$menu = is_array( $menu ) ? $menu : array();

		// Each main menu item
		foreach ( $menu as $item_key => $item ) {

			if ( ! is_array( $item ) || ! isset( $item[2] ) ) {
				continue;
			}

			$item_slug = $item[2];
			$item_title = $item[0];

			// Only continue if it doesn't already have a number (or any other HTML), except if that number is 0 (comments awaiting moderation)
			if ( is_numeric( strpos( $item_title, '<' ) ) && ! is_numeric( strpos( $item_title, 'count-0' ) ) ) {
				continue;
			}

			// Post types: Get number of published posts from a user-specific transient
			if ( is_numeric( strpos( $item_slug, 'edit.php' ) ) ) {
				$post_type = explode( 'post_type=', $item_slug );
				$post_type = isset( $post_type[1] ) ? $post_type[1] : 'post';
				$transient = get_transient( 'clientside-posttype-count' );
				$transient = is_array( $transient ) ? $transient : array();
				if ( isset( $transient[ $post_type ][ get_current_user_id() ] ) ) {
					$post_count = $transient[ $post_type ][ get_current_user_id() ];
				}
				else {

					// Get author's post count
					$post_type_object = get_post_type_object( $post_type );
					if ( ! current_user_can( $post_type_object->cap->edit_others_posts ) ) {

						// Borrowed from class-wp-posts-list-table.php, WP_Posts_List_Table->__construct()
						global $wpdb;
						$exclude_states = get_post_stati( array(
							'show_in_admin_all_list' => false
						) );
						$post_count = intval( $wpdb->get_var( $wpdb->prepare( "
							SELECT COUNT( 1 )
							FROM $wpdb->posts
							WHERE post_type = %s
							AND post_status NOT IN ( '" . implode( "','", $exclude_states ) . "' )
							AND post_author = %d
						", $post_type, get_current_user_id() ) ) );

					}

					// Get all posts count
					else {
						$post_count = wp_count_posts( $post_type );
						$post_count = $post_count->publish;
					}

					$transient[ $post_type ][ get_current_user_id() ] = $post_count;
					set_transient( 'clientside-posttype-count', $transient, WEEK_IN_SECONDS );

				}
			}

			// Media: Get total file count from a non-user-specific transient
			else if ( $item_slug == 'upload.php' ) {
				$transient = get_transient( 'clientside-media-count' );
				if ( $transient ) {
					$post_count = $transient;
				}
				else {
					$post_count = wp_count_posts( 'attachment' );
					$post_count = $post_count->inherit;
					set_transient( 'clientside-media-count', $post_count, WEEK_IN_SECONDS );
				}
			}

			// Comments: Get total number of comments
			//todo Transient - But probably already cached by WP
			else if ( $item_slug == 'edit-comments.php' ) {
				$post_count = wp_count_comments();
				$post_count = $post_count->total_comments;
			}

			// Users: Get number of users
			else if ( $item_slug == 'users.php' ) {
				if ( is_multisite() && is_network_admin() ) {
					$post_count = get_sitestats();
					if ( ! isset( $post_count['users'] ) ) {
						continue;
					}
					$post_count = $post_count['users'];
				}
				else {
					$transient = get_transient( 'clientside-user-count' );
					if ( $transient ) {
						$post_count = $transient;
					}
					else {
						$post_count = count_users();
						$post_count = $post_count['total_users'];
						set_transient( 'clientside-user-count', $post_count, WEEK_IN_SECONDS );
					}
				}
			}

			// Plugins: Get number of plugins
			else if ( $item_slug == 'plugins.php' ) {
				$post_count = get_transient( 'plugin_slugs' );
				if ( $post_count == false ) {
					$post_count = array_keys( get_plugins() );
					set_transient( 'plugin_slugs', $post_count, DAY_IN_SECONDS );
				}
				$post_count = count( $post_count );
			}

			// Multisite: Themes
			else if ( is_multisite() && is_network_admin() && $item_slug == 'themes.php' ) {
				$post_count = get_site_transient( 'update_themes' );
				if ( ! $post_count || ! isset( $post_count->checked ) ) {
					continue;
				}
				$post_count = count( $post_count->checked );
			}

			// Multisite: Sites
			else if ( is_multisite() && is_network_admin() && $item_slug == 'sites.php' ) {
				$post_count = get_sitestats();
				if ( ! isset( $post_count['blogs'] ) ) {
					continue;
				}
				$post_count = $post_count['blogs'];
			}

			else {
				continue;
			}

			// Format & display
			$post_count_display = $post_count > 999 ? '999+' : $post_count;
			$menu[ $item_key ][0] .= '<span class="clientside-menu-number" title="' . esc_attr( $post_count . ' ' . $item_title ) . '">' . $post_count_display . '</span>';

		}

	}

	// Clear the posttype menu counter transient when saving a post
	static function action_reset_posttype_counters( $post_id ) {

		// Only if menu counters are enabled
		if ( ! Clientside_Options::get_saved_option( 'enable-menu-counters' ) ) {
			return;
		}

		$post_type = get_post_type( $post_id );
		$transient = get_transient( 'clientside-posttype-count' );
		$transient = is_array( $transient ) ? $transient : array();
		$transient[ $post_type ] = array();
		set_transient( 'clientside-posttype-count', $transient, WEEK_IN_SECONDS );

	}

	// Clear the Media menu counter transient when adding/deleting an attachment
	static function action_reset_media_counters( $attachment_id ) {

		// Only if menu counters are enabled
		if ( ! Clientside_Options::get_saved_option( 'enable-menu-counters' ) ) {
			return;
		}

		delete_transient( 'clientside-media-count' );

	}

	// Clear the User menu counter transient when adding/deleting a user
	static function action_reset_user_counters( $user_id ) {

		// Only if menu counters are enabled
		if ( ! Clientside_Options::get_saved_option( 'enable-menu-counters' ) ) {
			return;
		}

		delete_transient( 'clientside-user-count' );

	}

}
?>
