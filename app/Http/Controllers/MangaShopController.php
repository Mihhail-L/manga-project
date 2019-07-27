<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volume;
use App\Category;
use App\Tag;
use App\Manga;

class MangaShopController extends Controller
{
    public function index() {
        $volumes = Volume::paginate(12);
        $categories = Category::all();
        $tags = Tag::all();

        return view('mangashop.index')
                ->with('volumes', $volumes)
                ->with('categories', $categories)
                ->with('tags', $tags);
    }

    public function show($id) {
        $volume = Volume::findOrFail($id);
        $manga = $volume->manga();

        return view('mangashop.show')->with('volume', $volume)->with('manga', $manga);
    }

    public function categoryFilter($id) {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $filter = 'category';
        $tags = Tag::all();
        $mangas = $category->mangas()->where('category_id', $id)->get();
        $i= 0;
        foreach($mangas as $manga) {
            $manga_ids[] = $manga->id;
        }
        $volumes = $manga->volumes()->whereIn('manga_id', $manga_ids)->get();
        dd($volumes);


        return view('mangashop.index')
                ->with('volumes', $volumes)
                ->with('categories', $categories)
                ->with('tags', $tags)
                ->with('filter', $filter);
        
    }
}
