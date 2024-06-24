<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class Globals extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register(): void
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' => 'General Configuration',
                'menu_title' => 'Globals',
                'menu_slug' => 'fieldset-globals',
                'capability' => 'edit_posts',
                'redirect' => false,
            ]);

            acf_add_options_sub_page([
                'page_title' => 'Social Media',
                'menu_title' => 'Social Media',
                'parent_slug' => 'fieldset-globals',
            ]);

            // NOTE: Uncomment the following lines to add additional sub pages
            // acf_add_options_sub_page([
            //     'page_title' => 'Footer Settings',
            //     'menu_title' => 'Footer',
            //     'parent_slug' => 'fieldset-globals',
            // ]);
        }
    }

    /* π ----
    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot(): void
    {
    }
}
