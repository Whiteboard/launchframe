<?php

namespace App\Http;

use Rareloop\Lumberjack\Http\Lumberjack;
use Timber\Timber;

class Launchframe extends Lumberjack
{
    /**
     * @param  mixed  $context
     */
    public function addToContext($context): mixed
    {
        $context['environment'] = getenv('WP_ENV');
        $context['is_home'] = is_home();
        $context['is_front_page'] = is_front_page();
        $context['is_logged_in'] = is_user_logged_in();
        $context['globals'] = get_fields('option');

        $image_sizes = collect(require dirname(__DIR__).'/../config/images.php');
        $context['image_sizes'] = [];
        foreach ($image_sizes['sizes'] as $size) {
            $size = collect($size);
            array_push($context['image_sizes'], $size->get('width'));
        }

        $context['nav'] = [
            'primary' => Timber::get_menu('primary'),
            'overlay' => Timber::get_menu('overlay'),
            'footer' => [
                '1' => Timber::get_menu('footer-1'),
                '2' => Timber::get_menu('footer-2'),
            ],
        ];

        $context['people'] = Timber::get_posts([
            'post_type' => 'person',
            'order' => 'ASC',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'posts_per_page' => -1,
        ]);

        $context['blog_categories'] = Timber::get_terms('category', [
            'hide_empty' => true,
        ]);
        $context['blog_link'] = get_post_type_archive_link('post');

        $protocol = ((! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $context['url'] = $url;

        return $context;
    }
}
