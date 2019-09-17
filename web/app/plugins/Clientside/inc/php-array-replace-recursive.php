<?php
/* For compatibility purposes, since array_replace_recursive only exists in PHP 5.3 */
/* Adapted from: http://php.net/manual/en/function.array-replace-recursive.php */

if ( ! function_exists( 'array_replace_recursive' ) ) {
	function array_replace_recursive( $array, $array1 ) {
		if ( ! function_exists( 'recurse' ) ) {
			function recurse( $array, $array1 ) {
				foreach ( $array1 as $key => $value ) {
					// Create new key in $array, if it is empty or not an array
					if ( ! isset( $array[ $key ] ) || ( isset( $array[ $key ] ) && ! is_array( $array[ $key ] ) ) ) {
						$array[ $key ] = array();
					}

					// Overwrite the value in the base array
					if ( is_array( $value ) ) {
						$value = recurse( $array[ $key ], $value );
					}
					$array[ $key ] = $value;
				}
				return $array;
			}
		}

		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if ( ! is_array( $array ) ) {
			return $array;
		}
		for ( $i = 1; $i < count( $args ); $i++ ) {
			if ( is_array( $args[ $i ] ) ) {
				$array = recurse( $array, $args[ $i ] );
			}
		}
		return $array;
	}
}