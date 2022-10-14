<?php

namespace App\Http;

use Rareloop\Lumberjack\Http\Lumberjack;
use App\Menu\Menu;

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

        return $context;
    }
}
