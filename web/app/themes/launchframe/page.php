<?php

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

class PageController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Page();

        $context['page'] = $page;
        $context['title'] = $page->title;
        $context['content'] = $page->content;

        return new TimberResponse('pages/page.twig', $context);
    }
}
