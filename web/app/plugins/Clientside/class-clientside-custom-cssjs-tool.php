<?php
/*
 * Clientside custom css/js tool class
 * Contains methods to apply the Custom CSS/JS tool's functionality
 */

class Clientside_Custom_CSSJS_Tool {

	// Inject custom CSS in the site header (Custom CSS/JS tool)
	static function action_inject_custom_site_css_header() {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			return;
		}

		// Determine this area's value
		// If this tool is network disabled, use the network defaults
		if ( Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$value = Clientside_Options::get_saved_network_default_option( 'custom-site-css' );
		}
		// Use the regular site options
		else {
			$value = Clientside_Options::get_saved_option( 'custom-site-css' );
		}

		// Only if custom CSS is supplied
		if ( ! $value ) {
			return;
		}

		// Output CSS
		echo '<style type="text/css" class="clientside-custom-css">';
		echo $value;
		echo '</style>';

	}

	// Inject custom JS in the site header (Custom CSS/JS tool)
	static function action_inject_custom_site_js_header() {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			return;
		}

		// Determine this area's value
		// If this tool is network disabled, use the network defaults
		if ( Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$value = Clientside_Options::get_saved_network_default_option( 'custom-site-js-header' );
		}
		// Use the regular site options
		else {
			$value = Clientside_Options::get_saved_option( 'custom-site-js-header' );
		}

		// Only if custom JS is supplied
		if ( ! $value ) {
			return;
		}

		// Output JS
		echo '<script type="text/javascript" class="clientside-custom-js">';
		echo $value;
		echo '</script>';

	}

	// Inject custom JS in the site footer (Custom CSS/JS tool)
	static function action_inject_custom_site_js_footer() {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			return;
		}

		// Determine this area's value
		// If this tool is network disabled, use the network defaults
		if ( Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$value = Clientside_Options::get_saved_network_default_option( 'custom-site-js-footer' );
		}
		// Use the regular site options
		else {
			$value = Clientside_Options::get_saved_option( 'custom-site-js-footer' );
		}

		// Only if custom JS is supplied
		if ( ! $value ) {
			return;
		}

		// Output JS
		echo '<script type="text/javascript" class="clientside-custom-js">';
		echo $value;
		echo '</script>';

	}

	// Inject custom CSS in the admin header (Custom CSS/JS tool)
	static function action_inject_custom_admin_css_header() {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			return;
		}

		// Determine this area's value
		// If this tool is network disabled, use the network defaults
		if ( Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$value = Clientside_Options::get_saved_network_default_option( 'custom-admin-css' );
		}
		// Use the regular site options
		else {
			$value = Clientside_Options::get_saved_option( 'custom-admin-css' );
		}

		// Only if custom CSS is supplied
		if ( ! $value ) {
			return;
		}

		// Output CSS
		echo '<style class="clientside-custom-css">';
		echo $value;
		echo '</style>';

	}

	// Inject custom JS in the admin header (Custom CSS/JS tool)
	static function action_inject_custom_admin_js_header() {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			return;
		}

		// Determine this area's value
		// If this tool is network disabled, use the network defaults
		if ( Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$value = Clientside_Options::get_saved_network_default_option( 'custom-admin-js-header' );
		}
		// Use the regular site options
		else {
			$value = Clientside_Options::get_saved_option( 'custom-admin-js-header' );
		}

		// Only if custom JS is supplied
		if ( ! $value ) {
			return;
		}

		// Output JS
		echo '<script class="clientside-custom-js">';
		echo $value;
		echo '</script>';

	}

	// Inject custom JS in the admin footer (Custom CSS/JS tool)
	static function action_inject_custom_admin_js_footer() {

		// Skip if this tool is site-disabled (when network-disabled, it should load with network defaults)
		if ( ! Clientside_Options::get_saved_option( 'enable-custom-cssjs-tool' ) && ! Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			return;
		}

		// Determine this area's value
		// If this tool is network disabled, use the network defaults
		if ( Clientside_Options::get_saved_network_option( 'disable-custom-cssjs-tool' ) ) {
			$value = Clientside_Options::get_saved_network_default_option( 'custom-admin-js-footer' );
		}
		// Use the regular site options
		else {
			$value = Clientside_Options::get_saved_option( 'custom-admin-js-footer' );
		}

		// Only if custom JS is supplied
		if ( ! $value ) {
			return;
		}

		// Output JS
		echo '<script class="clientside-custom-js">';
		echo $value;
		echo '</script>';

	}

}
