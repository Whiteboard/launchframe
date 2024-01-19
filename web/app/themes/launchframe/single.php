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

        $related_posts = Timber::get_posts([
            'post_type' => $post->post_type,
            'post__not_in' => [$post->ID],
            'category_name' => $post->category,
            'posts_per_page' => 3,
        ]);
        $context['related'] = $related_posts;

        return new TimberResponse('templates/single.twig', $context);
    }
}
