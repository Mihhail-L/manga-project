<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manga;
use App\Tag;
use App\Category;

class WelcomeController extends Controller
{
    public function index() {
        $mangas = Manga::all();
        $tags = Tag::all();
        $categories = Category::all();

        return view('welcome')->with('mangas', $mangas)->with('tags', $tags)->with('categories', $categories);
    }
}
