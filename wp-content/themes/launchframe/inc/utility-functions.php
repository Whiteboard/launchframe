<?php

    // -------------------------------------------------------------------------
    // Remove WP Embed
    // -------------------------------------------------------------------------

    function my_deregister_scripts() {
    	wp_deregister_script( 'wp-embed' );
    }
    add_action( 'wp_footer', 'my_deregister_scripts' );

    // -------------------------------------------------------------------------
    // Aysnc WP Enqueue Script Functions
    // -------------------------------------------------------------------------

    function my_async_scripts($url) {
        if ( strpos( $url, '#async') === false )
            return $url;
        else if ( is_admin() )
            return str_replace( '#async', '', $url );
        else
            return str_replace( '#async', '', $url )."' async='async";
    }
    add_filter( 'clean_url', 'my_async_scripts', 11, 1 );

    // -------------------------------------------------------------------------
    // Remove Wordpress Version for Security Purposes
    // -------------------------------------------------------------------------

    function complete_version_removal() {
        return '';
    }
    add_filter('the_generator', 'complete_version_removal');


?>
