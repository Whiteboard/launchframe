<?php

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class ArchiveController extends Controller
{
    public function handle(): TimberResponse
    {
        $context = Timber::get_context();
        $context['title'] = 'Archive';

        $term = get_queried_object();

        if (is_day()) {
            $context['title'] = 'Archive: '.get_the_date('D M Y');
        } elseif (is_month()) {
            $context['title'] = 'Archive: '.get_the_date('M Y');
        } elseif (is_year()) {
            $context['title'] = 'Archive: '.get_the_date('Y');
        } elseif (is_tag()) {
            $context['title'] = single_tag_title('', false);
        } elseif (is_category()) {
            $context['title'] = single_cat_title('', false);
            $context['slug'] = $term->slug;
            $context['overline'] = get_bloginfo('name');
        } elseif (is_post_type_archive()) {
            $context['title'] = post_type_archive_title('', false);
        }

        $context['posts'] = Timber::get_posts();
        $context['pagination'] = Timber::get_pagination();

        return new TimberResponse('templates/posts.twig', $context);
    }
}
