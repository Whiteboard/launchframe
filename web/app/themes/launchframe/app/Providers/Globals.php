<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class Globals extends ServiceProvider
{
    /* π ----
    // :: REGISTER
    // :: Register any app specific items into the container
    // : ---------------------------------- */
    public function register()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'     => 'Globals Settings',
                'menu_title'    => 'Globals',
                'menu_slug'     => 'fieldset-globals',
                'capability'    => 'edit_posts',
                'redirect'        => false
            ));

            acf_add_options_sub_page(array(
                'page_title'     => 'Footer Settings',
                'menu_title'    => 'Footer',
                'parent_slug'    => 'fieldset-globals',
            ));
        }
    }

    /* π ----
    // :: BOOT
    // :: Perform any additional boot required for this application
    // : ---------------------------------- */
    public function boot()
    { }
}
