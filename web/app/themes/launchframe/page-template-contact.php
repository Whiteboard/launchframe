<?php

/*
 * Template Name: Contact
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

class PageTemplateContactController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Page();

        $context['page'] = $page;
        $context['title'] = $page->title;

        return new TimberResponse('templates/page-contact.twig', $context);
    }
}
