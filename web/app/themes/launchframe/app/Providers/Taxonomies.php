<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class Taxonomies extends ServiceProvider
{
    public function register()
    {
        // self::example();
    }

    private static function example()
    {
        register_taxonomy(
            'example',
            array('your-post-type'),
            array(
                'labels' => array(
                    'name' => 'Terms',
                    'singular_name' => 'Term',
                    'search_items' => 'Search Terms',
                    'all_items' => 'All Terms',
                    'parent_item' => 'Parent Term',
                    'edit_item' => 'Edit Term',
                    'view_item' => 'View Term',
                    'update_item' => 'Update Term',
                    'add_new_item' => 'Add New Term',
                    'new_item_name' => 'New Term Name',
                ),
                'hierarchical' => true,
                'show_admin_column' => true,
                'show_ui' => true,
                'show_in_rest' => true
            )
        );
    }

    public function boot()
    {
    }
}
