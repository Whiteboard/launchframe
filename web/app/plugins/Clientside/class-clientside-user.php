<?php
/*
 * Clientside User Class
 * Contains user management related methods
 */

class Clientside_User {

	// Return all available roles
	static function get_all_roles( $all = false ) {

		// Standard roles
		$roles = $all ? wp_roles()->roles : get_editable_roles();

		// Simplify data
		foreach ( $roles as $key => $role ) {
			$roles[ $key ]['slug'] = $key;
		}

		// Add Super Admin in case of multisite
		if ( is_multisite() ) {
			$roles = array_reverse( $roles );
			$roles['super'] = array(
				'slug' => 'super',
				'name' => _x( 'Network Administrator', 'User role', 'clientside' ),
				'capabilities' => $roles['administrator']['capabilities']
			);
			$roles = array_reverse( $roles );
		}

		// Return
		return $roles;

	}

	// Return a user's role
	static function get_user_role( $user_id = 0, $multiple = false ) {

		// Invalid arguments
		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}
		if ( ! $user_id || ! is_numeric( $user_id ) ) {
			return null;
		}

		// Super admin (not included otherwise)
		if ( is_multisite() && is_super_admin( $user_id ) ) {
			if ( $multiple ) {
				return array( 'super' );
			}
			else {
				return 'super';
			}
		}

		// All other roles
		$user = new WP_User( $user_id );
		if ( $user === false ) {
			return null;
		}
		$role = $user->roles;

		// Return
		if ( $multiple ) {
			return is_array( $role ) ? $role : array( $role );
		}
		else {
			return is_array( $role ) ? array_shift( $role ) : $role;
		}

	}

	// Return a user's role, meant for displaying
	static function get_user_role_display( $user_id = 0 ) {

		// Invalid arguments
		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}
		if ( ! $user_id || ! is_numeric( $user_id ) ) {
			return '';
		}

		// Super admin
		if ( is_multisite() && is_super_admin( $user_id ) ) {
			return _x( 'Network Administrator', 'User role', 'clientside' );
		}

		// All other roles
		global $wp_roles;
		$role_names = array();
		foreach ( self::get_user_role( $user_id, 'multiple' ) as $role_slug ) {
			$role_names[] = isset( $wp_roles->roles[ $role_slug ]['name'] ) ? translate_user_role( $wp_roles->roles[ $role_slug ]['name'] ) : ucfirst( $role_slug );
		}
		return implode( ', ', $role_names );

	}

	// Return a user's full name or display name
	static function get_full_name( $user_object = false ) {

		if ( ! $user_object ) {
			$user_object = wp_get_current_user();
		}

		// Return
		if ( $user_object->first_name && $user_object->last_name ) {
			return $user_object->first_name . ' ' . $user_object->last_name;
		}
		else if ( $user_object->first_name || $user_object->last_name ) {
			return $user_object->first_name . $user_object->last_name;
		}
		else {
			return $user_object->display_name;
		}

	}

	// Return what user capability is necessary for Clientside management
	static function get_admin_cap() {

		if ( is_multisite() && Clientside_Options::get_saved_network_option( 'network-admins-only' ) ) {
			return apply_filters( 'clientside-super-admin-cap', 'manage_network_options' );
		}
		//return apply_filters( 'clientside-admin-cap', 'edit_theme_options' );
		return apply_filters( 'clientside-admin-cap', 'manage_options' );

	}

	// Quick check to see if the current user can perform Clientside Admin actions
	static function is_admin() {
		return current_user_can( self::get_admin_cap() );
	}

}
?>
