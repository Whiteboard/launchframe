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

        $context['title'] = 'Search Results';

        $context['query'] = htmlspecialchars($searchQuery);

        global $wp_query;
        $count = $wp_query->found_posts;

        if($count == 1) {
            $context['result'] = 'We found ' . $count . ' result for ' . htmlspecialchars($searchQuery) . '</span>';
        } else {
            $context['result'] = 'We found ' . $count . ' results for ' . htmlspecialchars($searchQuery) . '</span>';
        }

        $context['entries'] = Timber::get_posts();

        return new TimberResponse('templates/search.twig', $context);
    }
}
