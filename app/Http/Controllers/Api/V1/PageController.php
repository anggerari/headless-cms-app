<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PageResource;
use App\Models\Page;
use App\Enums\PageStatus;

class PageController extends Controller
{
    /**
     * Display a listing of the published pages.
     */
    public function index()
    {
        $pages = Page::query()
            ->where('status', PageStatus::PUBLISHED)
            ->latest()
            ->paginate(10);

        return PageResource::collection($pages);
    }

    /**
     * Display a single, published page.
     */
    public function show(Page $page)
    {
        if ($page->status !== PageStatus::PUBLISHED) {
            abort(404);
        }

        return new PageResource($page);
    }
}
