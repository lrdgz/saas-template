<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page)
    {
        return view('pages.dynamic', compact('page'));
    }
}
