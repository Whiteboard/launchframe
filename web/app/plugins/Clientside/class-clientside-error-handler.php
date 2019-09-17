<?php

class Clientside_Error_Handler {

	static $errors = array();

	// Tell PHP to send us the errors instead of outputting them above the HTML document
	static function action_collect_php_errors() {

		// Only if errors are supposed to display anyway
		if ( ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) || ( defined( 'WP_DEBUG_DISPLAY' ) && ! WP_DEBUG_DISPLAY ) ) {
			return;
		}

		// Only if the option is enabled & this is the admin area
		if ( ! is_admin() || Clientside_Options::get_saved_option( 'disable-cli-error-handling' ) ) {
			return;
		}

		set_error_handler( array( __CLASS__, 'error_handler' ) );

	}

	// Write a PHP error to a custom error message to output later
	static function error_handler( $number, $error, $file = '', $line = '', $context = '' ) {

		// Error type not in error_reporting or error trigger prepended with @
		if ( ( error_reporting() & $number ) == 0 ) {
			return;
		}

		// Compose a readable error message to later output in an appropriate place
		$message = sprintf( _x( 'The following PHP error occurred: "%s" in the file: %s on line %d', 'A PHP error message', 'clientside' ), $error, $file, $line );

		// Print it to WP's debug.log if this is requested
		if ( WP_DEBUG_LOG ) {
			error_log( $message );
		}

		// Add to the list of errors
		self::$errors[] = $message;

	}

	// Output the collected PHP errors
	static function action_output_php_errors() {

		// Only if there are any
		if ( ! count( self::$errors ) ) {
			return;
		}

		// Output HTML
		foreach ( self::$errors as $error ) {
			echo '<div class="error">' . $error . '</div>';
		}

	}

}

?>
