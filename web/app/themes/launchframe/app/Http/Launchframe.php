<?php

namespace App\Http;

use Rareloop\Lumberjack\Http\Lumberjack;
use App\Menu\Menu;
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

        $context['menu'] = new Menu('main-nav');
        $context['overlay_menu'] = new Menu('overlay-nav');
        $context['footer_menu_one'] = new Menu('footer-1');
        $context['footer_menu_two'] = new Menu('footer-2');
        $context['footer_menu_three'] = new Menu('footer-3');
        $context['footer_menu_four'] = new Menu('footer-4');

        $context['people'] = Timber::get_posts( [
            'post_type' => 'person',
            'order'     => 'ASC',
            'meta_key' => 'last_name',
            'orderby'   => 'meta_value',
            'posts_per_page' => -1
        ] );

        return $context;
    }
}
