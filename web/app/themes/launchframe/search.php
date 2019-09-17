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

        $context['title'] = '<div class="text-6xl">Search results for</div><div class="text-red-500">' . htmlspecialchars($searchQuery) . '</div>';
        $context['posts'] = Post::query([
            's' => $searchQuery,
        ]);


        return new TimberResponse('pages/posts.twig', $context);
    }
}
