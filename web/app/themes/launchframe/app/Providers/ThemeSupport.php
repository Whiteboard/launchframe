<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class ThemeSupport extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register()
    {

    }

    /* π ----
    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot()
    {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');

        // Roots.io Soil plugin
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-disable-trackbacks');
        add_theme_support('soil-js-to-footer');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');
    }
}
