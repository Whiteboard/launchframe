<?php

/**
 * Search results page
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class SearchController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $searchQuery = get_search_query();
        $query = htmlspecialchars($searchQuery);

        global $wp_query;
        $count = $wp_query->found_posts;

        if ($count == 1) {
            $context['title'] = 'We found '.$count.' result for "'.$query.'"';
        } else {
            $context['title'] = 'We found '.$count.' results for "'.$query.'"';
        }

        $context['posts'] = Timber::get_posts();

        $context['overline'] = 'Search Results';
        $context['is_search'] = true;
        $context['pagination'] = Timber::get_pagination();

        return new TimberResponse('templates/posts.twig', $context);
    }
}
