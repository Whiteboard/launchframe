<?php

/**
 * The Template for displaying all single posts
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SingleController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $post = new Post();

        $context['page'] = $post;
        $context['title'] = $post->title;
        $context['content'] = $post->content;

        return new TimberResponse('pages/page.twig', $context);
    }
}
