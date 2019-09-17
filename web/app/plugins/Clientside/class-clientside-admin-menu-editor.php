<?php
/*
 * Clientside Admin Menu Editor class
 * Contains method to build the Admin Menu Editor tool and perform the related menu manipulations
 */

class Clientside_Admin_Menu_Editor {

	static $main_menus = array();
	static $sub_menus = array();
	static $new_order = array();
	static $unremove_items = array();
	static $remove_items = array();
	static $saved_customizations = array();
	static $admin_locked = array(
		'tools.php',
		'submenu-clientside-options-general',
		'submenu-clientside-admin-menu-editor'
	);
	static $title_locked = array(
		'clientside-menu-collapse',
		'separator1',
		'separator2',
		'separator-last',
		'separator-woocommerce'
	);

	// Save the unmodified admin menu layout to variables
	static function action_gather_admin_menu() {

		// Only on the admin menu editor page
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'clientside-admin-menu-editor' ) {

			global $menu;
			global $submenu;

			// Gather admin pages to ignore
			$hidden_pages = array();
			foreach ( Clientside_Pages::get_pages() as $clientside_page ) {
				if ( ! $clientside_page['in-menu'] ) {
					$hidden_pages[] = $clientside_page['slug'];
				}
			}

			// Save as $slug => $item array
			ksort( $menu );
			foreach ( $menu as $position => $mainmenu_item ) {

				// Required param
				if ( ! isset( $mainmenu_item[2] ) ) {
					continue;
				}

				// Skip exceptions
				if ( isset( $mainmenu_item[1] ) && $mainmenu_item[1] == 'manage_links' && isset( $mainmenu_item[5] ) && $mainmenu_item[5] == 'menu-links' ) {
					continue;
				}

				// Passed
				self::$main_menus[ $mainmenu_item[2] ] = $mainmenu_item;

			}

			// Add exceptions (normally not available for admin role)
			// 1. Profile (see wp-admin/menu.php:214+)
			self::$main_menus['profile.php'] = array(
				__( 'Profile' ),
				'!manage_options', // Normally 'read' but that would make it appear on admin roles
				'profile.php',
				'',
				'menu-top menu-icon-users',
				'menu-users',
				'dashicons-admin-users'
			);

			// Filter submenu items
			foreach ( $submenu as $mainmenu_slug => $submenu_items ) {

				foreach ( $submenu_items as $submenu_item_key => $submenu_item ) {

					// Skip hidden admin pages
					if ( in_array( $submenu_item[2], $hidden_pages ) ) {
						unset( $submenu_items[ $submenu_item_key ] );
					}

				}

				// Save as $parent_slug => $items array
				self::$sub_menus[ $mainmenu_slug ] = $submenu_items;

			}

		}

	}

	// Output the HTML for the editable menu list
	static function print_menu_editor() {

		$view_site_button_url = apply_filters( 'clientside-view-site-button-url', home_url() );

		// Apply custom re-order to the list
		$customizations = self::get_menu_customizations();
		if ( is_null( $customizations ) ) {
			$main_menus_ordered = self::$main_menus;
		}
		else {
			$unused_main_menus = self::$main_menus;
			foreach ( $customizations as $key => $value ) {

				// Exception: Replace legacy view-site button slug
				if ( $key == $view_site_button_url . '[slug]' && isset( self::$main_menus[ 'clientside-view-site' ] ) ) {
					if ( isset( self::$main_menus[ 'clientside-view-site-logo' ] ) ) {
						$main_menus_ordered[] = self::$main_menus[ 'clientside-view-site-logo' ];
						unset( $unused_main_menus[ 'clientside-view-site-logo' ] );
					}
					$main_menus_ordered[] = self::$main_menus[ 'clientside-view-site' ];
					unset( $unused_main_menus[ 'clientside-view-site' ] );
				}

				// Exception: If this customization is for view-site but $main_menus doesn't have view-site (and does have view-site-logo), put view-site-logo here
				else if ( $key == 'clientside-view-site[slug]' && ! isset( self::$main_menus[ 'clientside-view-site'] ) && isset( self::$main_menus[ 'clientside-view-site-logo'] ) ) {
					$main_menus_ordered[] = self::$main_menus[ 'clientside-view-site-logo' ];
					unset( $unused_main_menus[ $value ] );
				}

				// Exception: If this customization is for view-site-logo but $main_menus doesn't have view-site-logo (and does have view-site), put view-site here
				else if ( $key == 'clientside-view-site-logo[slug]' && ! isset( self::$main_menus[ 'clientside-view-site-logo'] ) && isset( self::$main_menus[ 'clientside-view-site'] ) ) {
					$main_menus_ordered[] = self::$main_menus[ 'clientside-view-site' ];
					unset( $unused_main_menus[ $value ] );
				}

				// Exception: If this customization is for view-site or view-site-logo and only one of them exists in customization but they both exist in $main_menus, put them together
				else if ( in_array( $key, array( 'clientside-view-site[slug]', 'clientside-view-site-logo[slug]' ) ) && ( ! isset( $customizations['clientside-view-site[slug]'] ) || ! isset( $customizations['clientside-view-site-logo[slug]'] ) ) && ( isset( self::$main_menus['clientside-view-site'] ) && isset( self::$main_menus['clientside-view-site'] ) ) ) {
					$main_menus_ordered[] = self::$main_menus[ 'clientside-view-site-logo' ];
					$main_menus_ordered[] = self::$main_menus[ 'clientside-view-site' ];
					unset( $unused_main_menus[ $value ] );
				}

				else if ( $key == $value . '[slug]' && isset( self::$main_menus[ $value ] ) ) {
					$main_menus_ordered[] = self::$main_menus[ $value ];
					unset( $unused_main_menus[ $value ] );
				}

			}
			// Add new items (not previously customized) to the bottom
			foreach ( $unused_main_menus as $new_main_menu_slug => $new_main_menu_item ) {

				$main_menus_ordered[] = $new_main_menu_item;

			}

		}

		?>
		<ul class="clientside-admin-menu-editor clientside-admin-menu-editor-mainmenu">
			<?php
			foreach ( $main_menus_ordered as $mainmenu_item ) {
				$mainmenu_item_slug = $mainmenu_item[2];
				?>
				<li class="clientside-admin-menu-editor-item">
					<?php self::print_menu_editor_item( $mainmenu_item ); ?>

					<?php // Submenu ?>
					<?php if ( isset( self::$sub_menus[ $mainmenu_item_slug ] ) && count( self::$sub_menus[ $mainmenu_item_slug ] ) ) { ?>
						<ul class="clientside-admin-menu-editor clientside-admin-menu-editor-submenu">
							<?php foreach ( self::$sub_menus[ $mainmenu_item_slug ] as $submenu_item ) { ?>
								<li class="clientside-admin-menu-editor-item">
									<?php self::print_menu_editor_item( $submenu_item, $mainmenu_item_slug ); ?>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>

				</li>
				<?php
			}
			?>
		</ul>
		<?php

	}

	// Output the HTML for one menu item in the editable menu list
	static function print_menu_editor_item( $item_info, $mainmenu_item_slug = '' ) {

		

		$slug = $item_info[2];
		$customizations = self::get_menu_customizations();
		$name_prefix = $mainmenu_item_slug ? 'submenu-' . $slug : $slug;
		$array_key = $mainmenu_item_slug ? 'submenu-' . $slug : $slug;
		$array_key = str_replace( '&amp;', '&', $array_key );
		$title_data = is_numeric( strpos( $item_info[0], '<' ) ) ? trim( substr( $item_info[0], 0, strpos( $item_info[0], '<' ) ) ) : $item_info[0];
		$saved_title = isset( $customizations[ $array_key . '[title]' ] ) ? $customizations[ $array_key . '[title]' ] : '';
		$title_show = $saved_title ? $saved_title : ( $title_data ? $title_data : ( $item_info[3] ? $item_info[3] : _x( '(separator)', 'Item name in the admin menu editor', 'clientside' ) ) );
		$placeholder = $title_data != $saved_title ? $title_data : ( isset( $item_info[3] ) && $item_info[3] ? $item_info[3] : '' );
		$capability = $item_info[1];
		$icon = isset( $item_info[5] ) ? $item_info[5] : '';

		?>
		<div class="clientside-admin-menu-editor-page">

			<div class="clientside-admin-menu-editor-item-caption">
				<a href="#" class="clientside-admin-menu-editor-item-edit -expand"><?php _e( 'Edit', 'clientside' ); ?></a>
				<a href="#" class="clientside-admin-menu-editor-item-edit -collapse"><?php _e( 'Close', 'clientside' ); ?></a>
				<?php if ( ! $mainmenu_item_slug ) { ?>
					<span class="clientside-admin-menu-editor-item-drag-icon"></span>
				<?php } ?>
				<span class="clientside-admin-menu-editor-title-show"><?php echo $title_show; ?></span>
			</div>

			<div class="clientside-admin-menu-editor-item-settings">

				<input type="hidden" name="<?php echo esc_attr( $name_prefix . '[slug]' ); ?>" value="<?php echo esc_attr( $slug ); ?>">
				<?php if ( $mainmenu_item_slug ) { ?>
					<input type="hidden" name="<?php echo esc_attr( $name_prefix . '[parent]' ); ?>" value="<?php echo esc_attr( $mainmenu_item_slug ); ?>">
				<?php } ?>

				<?php if ( ! in_array( $array_key, self::$title_locked ) ) { ?>
					<div class="clientside-admin-menu-editor-form-title">
						<label class="clientside-admin-menu-editor-form-label" for="<?php echo esc_attr( $name_prefix . '[title]' ); ?>"><?php _e( 'Title', 'clientside' ); ?></label>
						<input type="text" id="<?php echo esc_attr( $name_prefix . '[title]' ); ?>" name="<?php echo esc_attr( $name_prefix . '[title]' ); ?>" value="<?php echo esc_attr( $saved_title ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>">
					</div>
				<?php } ?>

				<div class="clientside-admin-menu-editor-form-roles">
					<span class="clientside-admin-menu-editor-form-label"><?php _e( 'Role-based visibility', 'clientside' ); ?></span>
					<?php // Render role checkboxes ?>
					<?php foreach ( Clientside_User::get_all_roles() as $role ) {

						$field_id = $name_prefix . '_role_' . $role['slug'];
						$saved_role_value = null;
						$role_default = 1;
						$role_disabled = false;

						// If this admin has the required capability
						if ( Clientside_User::is_admin() && ( ( ! is_multisite() && $role['slug'] == 'administrator' ) || $role['slug'] == 'super' ) && current_user_can( $capability ) ) {
							$role_default = 1;
						}
						// If the role can not access this page anyway
						else if ( ! array_key_exists( $capability, $role['capabilities'] ) ) {
							$role_default = 0;
							//$role_disabled = true;
							//$saved_role_value = 0;
						}
						// If this role CANNOT access an excluded capability
						if ( strpos( $capability, '!' ) > -1 && ! array_key_exists( str_replace( '!', '', $capability ), $role['capabilities'] ) ) {
							$role_default = 1;
						}
						// Only let Super Admins manage Super Admin preferences
						if ( $role['slug'] == 'super' && ! is_super_admin() ) {
							$role_disabled = true;
						}
						// If the page is locked to the admin roles
						if ( Clientside_User::is_admin() && ( ( ! is_multisite() && $role['slug'] == 'administrator' ) || $role['slug'] == 'super' ) && in_array( $name_prefix, self::$admin_locked ) ) {
							$role_disabled = true;
							$saved_role_value = 1;
						}

						// Get saved value unless it's forced before
						if ( is_null( $saved_role_value ) ) {
							$saved_role_value = isset( $customizations[ $array_key . '[roles][' . $role['slug'] . ']' ] ) ? $customizations[ $array_key . '[roles][' . $role['slug'] . ']' ] : $role_default;
						}
						?>

						<label class="<?php if ( $role_disabled ) { echo 'form-label-disabled'; } ?>" for="<?php echo esc_attr( $field_id ); ?>">
							<input type="checkbox" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $name_prefix . '[roles][' . $role['slug'] . ']' ); ?>" value="1" <?php checked( $saved_role_value ); ?> <?php disabled( $role_disabled ); ?>>
							<?php echo $role['name']; ?>
						</label>

					<?php } ?>
				</div>

			</div>
		</div>
		<?php

	}

	// Return modified saved customization data
	static function get_menu_customizations() {

		// Get & save to cache
		if ( empty( self::$saved_customizations ) ) {

			// Get saved value
			$customizations = Clientside_Options::get_saved_option( 'admin-menu' );

			if ( ! $customizations ) {
				self::$saved_customizations = null;
			}
			else {
				$saved_customizations = json_decode( $customizations, true );

				// Restructure data array
				foreach ( $saved_customizations as $key_value_pair ) {
					self::$saved_customizations[ $key_value_pair['name'] ] = $key_value_pair['value'];
				}
			}

		}

		// Return
		return self::$saved_customizations;

	}

	// Prepare saved admin menu customizations to be processed at the right time
	static function action_prepare_menu_changes() {

		// Skip if this tool is disabled
		if ( Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) || ! Clientside_Options::get_saved_option( 'enable-admin-menu-editor-tool' ) ) {
			return;
		}

		// Only if admin menu customizations are available
		$customizations = self::get_menu_customizations();
		if ( is_null( $customizations ) ) {
			return;
		}

		// Prepare data to be processed
		foreach ( $customizations as $key => $value ) {

			// Only take each individual slug
			if ( ! in_array( $key, array( $value . '[slug]', 'submenu-' . $value . '[slug]' ) ) ) {
				continue;
			}

			$is_submenu = $key === 'submenu-' . $value . '[slug]';
			$slug = $is_submenu ? 'submenu-' . $value : $value;
			$parent = $is_submenu && isset( $customizations[ $slug . '[parent]' ] ) ? $customizations[ $slug . '[parent]' ] : false;
			$hide = isset( $customizations[ $slug . '[roles][' . Clientside_User::get_user_role() . ']' ] ) && ! $customizations[ $slug . '[roles][' . Clientside_User::get_user_role() . ']' ];

			// Prepare for re-ordering
			if ( ! $is_submenu ) {

				// If logo is missing in $customizations, add it above the view-site
				if ( $slug == 'clientside-view-site' && ! isset( $customizations[ 'clientside-view-site-logo[slug]'] ) ) {
					self::$new_order[] = 'clientside-view-site-logo';
				}

				// Replace legacy view-site slug
				if ( $slug == apply_filters( 'clientside-view-site-button-url', home_url() ) ) {
					self::$new_order[] = 'clientside-view-site-logo'; // Assume the menu logo is always 1 position above the view site button, if enabled
					$slug = 'clientside-view-site';
				}

				self::$new_order[] = $slug;

				// If view-site is missing in $customizations, add it below the view-site-logo
				if ( $slug == 'clientside-view-site-logo' && ! isset( $customizations[ 'clientside-view-site[slug]'] ) ) {
					self::$new_order[] = 'clientside-view-site';
				}

			}

			// Prepare for role-based hiding
			if ( $hide ) {
				self::$remove_items[] = array(
					'slug' => $value,
					'parent' => $parent
				);
			}

			// Prepare for role-based unhiding (when the item would normally be hidden by capability restriction but is specifically enabled in the menu editor)
			else {
				self::$unremove_items[] = $value;
			}

		}

	}

	// Apply the reordering of menu items, based on the admin menu customizations
	static function filter_apply_custom_menu_order( $order ) {

		// Skip if this tool is disabled
		if ( Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) || ! Clientside_Options::get_saved_option( 'enable-admin-menu-editor-tool' ) ) {
			return $order;
		}

		// Only if a new order is waiting
		if ( ! empty( self::$new_order ) ) {

			$original_order = $order;
			$order = self::$new_order;

			// Exceptions: Swap items with other items if they are different per user role but should be in the same position
			// 1. Visual Composer
			if ( in_array( 'vc-welcome', $original_order ) && in_array( 'vc-general', $order ) ) {
				foreach( $order as $key => $item ) {
					if ( $item == 'vc-general' ) {
						$order[ $key ] = 'vc-welcome';
					}
				}
			}

		}

		// Apply
		return $order;

	}

	// Apply the removal/hiding of menu items, based on the admin menu customizations
	static function action_apply_custom_menu_removal() {

		// Skip if this tool is disabled
		if ( Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) || ! Clientside_Options::get_saved_option( 'enable-admin-menu-editor-tool' ) ) {
			return;
		}

		// Exception: Always remove the "Links" item unless this is a pre WP 3.5 user account
		if ( ! current_user_can( 'manage_links' ) ) {
			remove_menu_page( 'link-manager.php' ); // In case of non-admin role
			remove_menu_page( 'edit-tags.php?taxonomy=link_category' ); // Admin role
		}

		// Only if items are to be removed
		if ( empty( self::$remove_items ) ) {
			return;
		}

		// Apply
		foreach ( self::$remove_items as $args ) {

			// Remove submenu item
			if ( $args['parent'] ) {

				// Reconstruct the page specific Appearance > Customizer menu item dynamically
				$startswith = 'customize.php';
				if ( $args['parent'] == 'themes.php' && substr( $args['slug'], 0, strlen( $startswith ) ) == $startswith ) {
					$args['slug'] = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
				}

				$result = remove_submenu_page( $args['parent'], $args['slug'] );

				// If the page was not found because of a slug mismatch, such as in case of custom post type submenus, it could be a & encoding issue
				if ( ! $result ) {
					remove_submenu_page( $args['parent'], str_replace( '&', '&amp;', $args['slug'] ) );
				}

			}

			// Remove main menu item
			else {
				remove_menu_page( $args['slug'] );
			}

			// Synonyms: Also remove items that are named differently for different user roles
			// Note that this is still rather buggy (the menu editor needs to be touched, then saved at least once for it to take affect)
			// 1. Visual Composer
			if ( ! $args['parent'] && $args['slug'] == 'vc-general' ) {
				remove_menu_page( 'vc-welcome' );
			}

			// 2. Elementor
			if ( ! $args['parent'] && $args['slug'] == 'elementor' ) {
				error_log( print_r( 'chk1', true ) );
				remove_menu_page( 'edit.php?post_type=elementor_library' );
			}

		}

	}

	// Apply role-based showing of menu items that would normally be hidden by capability restriction
	static function action_apply_custom_menu_unremoval() {

		// Skip if this tool is disabled
		if ( Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) || ! Clientside_Options::get_saved_option( 'enable-admin-menu-editor-tool' ) ) {
			return;
		}

		// Only if items are to be processed
		if ( empty( self::$unremove_items ) ) {
			return;
		}

		// Apply new cap to menu item
		global $menu;
		global $submenu;
		foreach ( self::$unremove_items as $item_slug ) {
			foreach ( $menu as $menu_item_key => $menu_item ) {
				if ( isset( $menu_item[2] ) && $menu_item[2] == $item_slug ) {
					$menu[ $menu_item_key ][1] = 'read';
				}
			}
			foreach ( $submenu as $main_menu_item_key => $main_menu_item ) {
				foreach ( $main_menu_item as $menu_item_key => $menu_item ) {
					if ( isset( $menu_item[2] ) && $menu_item[2] == $item_slug ) {
						$submenu[ $main_menu_item_key ][ $menu_item_key ][1] = 'read';
					}
				}
			}
		}

	}

	// Apply the renaming of menu items, based on the admin menu customizations
	static function action_apply_custom_menu_renaming() {

		// Skip if this tool is disabled
		if ( Clientside_Options::get_saved_network_option( 'disable-admin-menu-editor-tool' ) || ! Clientside_Options::get_saved_option( 'enable-admin-menu-editor-tool' ) ) {
			return;
		}

		global $menu;
		global $submenu;
		$customizations = self::get_menu_customizations();

		// Only continue if customizations are available
		if ( is_null( $customizations ) ) {
			return;
		}

		// Each main menu item
		foreach ( $menu as $mainmenu_key => $mainmenu_item ) {

			if ( isset( $mainmenu_item[2] ) ) {

				$mainmenu_item_slug = $mainmenu_item[2];
				$mainmenu_array_key = $mainmenu_item_slug;
				$mainmenu_array_key = str_replace( '&amp;', '&', $mainmenu_array_key );

				// Only continue if this item has saved customizations
				if ( isset( $customizations[ $mainmenu_array_key . '[title]' ] ) && $customizations[ $mainmenu_array_key . '[title]' ] ) {

					// Not if this item's title is locked
					if ( ! in_array( $mainmenu_array_key, self::$title_locked ) ) {

						// Replace the title, not touching the counter tags
						$original = $mainmenu_item[0];
						$original_stripped = is_numeric( strpos( $original, '<' ) ) ? substr( $original, 0, strpos( $original, '<' ) ) : $original;
						$title_stripped = $customizations[ $mainmenu_array_key . '[title]' ];
						$title = str_replace( $original_stripped, $title_stripped, $original );

						// Make custom menu titles WPML compatible
						//todo Needs more testing
						/*
						if ( $title_stripped != $original_stripped ) {

							// Register for WPML String Translation
							do_action( 'wpml_register_single_string', 'Admin menu translations', $title_stripped, $title_stripped );

							// Get maybe translated version
							$title = apply_filters( 'wpml_translate_single_string', $title_stripped, 'Admin menu translations', $title_stripped );

						}
						*/

						// Apply
						$menu[ $mainmenu_key ][0] = $title;

					}

				}

			}

			// Same for this item's submenu items
			if ( ! isset( $submenu[ $mainmenu_item_slug ] ) ) {
				continue;
			}
			foreach ( $submenu[ $mainmenu_item_slug ] as $submenu_key => $submenu_item ) {

				if ( ! isset( $submenu_item[2] ) ) {
					continue;
				}

				$submenu_item_slug = $submenu_item[2];
				$submenu_array_key = 'submenu-' . $submenu_item_slug;
				$submenu_array_key = str_replace( '&amp;', '&', $submenu_array_key );

				// Only continue if this item has saved customizations
				if ( ! isset( $customizations[ $submenu_array_key . '[title]' ] ) || ! $customizations[ $submenu_array_key . '[title]' ] ) {
					continue;
				}

				// Not if this item's title is locked
				if ( in_array( $submenu_array_key, self::$title_locked ) ) {
					continue;
				}

				// Replace the title, not touching the counter tags
				$original = $submenu_item[0];
				$original_stripped = is_numeric( strpos( $original, '<' ) ) ? substr( $original, 0, strpos( $original, '<' ) ) : $original;
				$title_stripped = $customizations[ $submenu_array_key . '[title]' ];
				$title = str_replace( $original_stripped, $title_stripped, $original );

				// Make custom menu titles WPML compatible
				//todo Needs more testing
				/*
				if ( $title_stripped != $original_stripped ) {

					// Register for WPML String Translation
					do_action( 'wpml_register_single_string', 'Admin menu translations', $title_stripped . ' (submenu)', $title_stripped );

					// Get maybe translated version
					$title = apply_filters( 'wpml_translate_single_string', $title_stripped, 'Admin menu translations', $title_stripped . ' (submenu)' );

				}
				*/

				// Apply
				$submenu[ $mainmenu_item_slug ][ $submenu_key ][0] = $title;

			}

		}

	}

}
?>
