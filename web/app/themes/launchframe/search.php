<?php

/**
 * Search results page
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SearchController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $searchQuery = get_search_query();

        $context['title'] = 'Search results for <span class="text-red-500">' . htmlspecialchars($searchQuery) . '</span>';
        $context['search_term'] = htmlspecialchars($searchQuery);
        $context['entries'] = Timber::get_posts();

        return new TimberResponse('templates/archive.twig', $context);
    }
}
