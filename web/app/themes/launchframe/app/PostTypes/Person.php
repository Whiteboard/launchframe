<?php

namespace App\PostTypes;

use Rareloop\Lumberjack\Post;

class Person extends Post
{
    public static function getPostType()
    {
        return 'person';
    }

    protected static function getPostTypeConfig()
    {
        return [
            $rewrite = array(
                'slug' => 'people',
                'with_front' => true,
                'pages' => true,
                'feeds' => true,
            ),
            'labels' => [
                'name' => __('People'),
                'singular_name' => __('Person'),
                'add_new_item' => __('Add New Person'),
            ],
            'public' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'show_in_nav_menus' => false,
            'supports' => array('title', 'thumbnail', 'editor'),
            'menu_icon' => 'dashicons-admin-users',
            'rewrite' => $rewrite,
            'show_in_rest' => true
        ];
    }
}
