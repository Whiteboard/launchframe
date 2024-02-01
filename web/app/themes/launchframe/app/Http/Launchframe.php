<?php

namespace App\Http;

use Rareloop\Lumberjack\Http\Lumberjack;
use Timber\Timber;

class Launchframe extends Lumberjack
{
    public function addToContext($context)
    {
        $context['environment'] = getenv('WP_ENV');
        $context['is_home'] = is_home();
        $context['is_front_page'] = is_front_page();
        $context['is_logged_in'] = is_user_logged_in();

        $context['globals'] = get_fields('option');

        $context['menu'] = Timber::get_menu('main-nav');
        $context['overlay_menu'] = Timber::get_menu('overlay-nav');
        $context['overlay_menu'] = Timber::get_menu('overlay-nav');
        $context['footer_menu_one'] = Timber::get_menu('footer-1');
        $context['footer_menu_two'] = Timber::get_menu('footer-2');
        $context['footer_menu_three'] = Timber::get_menu('footer-3');
        $context['footer_menu_four'] = Timber::get_menu('footer-4');

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
