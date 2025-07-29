<?php

// disable auto paragraph wrapping for Contact Form 7
function disable_cf7_autop() {
    return false;
}

if (function_exists('wpcf7')) {
    add_filter( 'wpcf7_autop_or_not', 'disable_cf7_autop' );
}