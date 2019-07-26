<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volume;
use App\Category;
use App\Tag;

class MangaShopController extends Controller
{
    public function index() {
        $volumes = Volume::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('mangashop.index')
                ->with('volumes', $volumes)
                ->with('categories', $categories)
                ->with('tags', $tags);
    }
}
