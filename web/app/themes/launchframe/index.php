<?php

/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class IndexController extends Controller
{
    public function handle(): TimberResponse
    {

        $context = Timber::get_context();
        $context['posts'] = Timber::get_posts();
        $context['pagination'] = Timber::get_pagination();

        $context['overline'] = get_bloginfo('name');
        $context['title'] = 'Blog Articles';

        return new TimberResponse('templates/posts.twig', $context);
    }
}
