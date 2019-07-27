<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manga;
use App\Tag;
use App\Category;
use App\Volume;
use App\Http\Requests\Manga\MangaRequest;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mangas = Manga::paginate(5)->onEachSide(1);
        $categories = Category::all();
        $tags = Tag::all();

        return view('manga.index')
                ->with('mangas', $mangas)
                ->with('categories', $categories)
                ->with('tags', $tags); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        $categories = Category::all();

        return view('manga.create')
        ->with('tags', $tags)
        ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MangaRequest $request)
    {
        $manga = new Manga;
        $manga->title = $request->title;
        $manga->author = $request->author;
        $manga->description = $request->description;
        $manga->start_date = $request->start_date;
        if(isset($request->end_date)) {
            $manga->end_date = $request->end_date;
        }
        if(isset($request->bundle_price)) {
            $manga->bundle_price = $request->bundle_price;
        }
        if(isset($request->image)) {
            // edit delete image.. $manga->deleteImage();
            $imagePath = request('image')->store('/manga_cover', 'public');
            $manga->image = $imagePath;
        }
        $manga->save();
        if($request->tags) {
            $manga->tags()->attach($request->tags);
        }
        if($request->categories) {
            $manga->categories()->attach($request->categories);
        }

        return redirect(route('manga.index'))->with('success', 'Successfully added Manga "'.$manga->title.'"!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Manga $manga)
    {
        $singular = $manga->title;

        $volumes = Volume::where('manga_id', $manga->id)->paginate(6);
        $categories = Category::all();
        $tags = Tag::all();

        return view('manga.index')
                ->with('manga', $manga)
                ->with('singular', $singular)
                ->with('volumes', $volumes)
                ->with('categories', $categories)
                ->with('tags', $tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manga = Manga::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $bundle_price = $manga->volumes->sum('price');

        return view('manga.edit')->with('manga', $manga)->with('tags', $tags)->with('categories', $categories)->with('bundleprice', $bundle_price);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manga = Manga::findOrFail($id);

        $manga_old = $manga->title;

        $manga->title = $request->title;
        $manga->author = $request->author;
        $manga->description = $request->description;
        $manga->start_date = $request->start_date;
        if(isset($request->end_date)) {
            $manga->end_date = $request->end_date;
        }
        if(isset($request->bundle_price)) {
            $manga->bundle_price = $request->bundle_price;
        }
        if(isset($request->image)) {
            $manga->deleteImage();
            $imagePath = request('image')->store('/manga_cover', 'public');
            $manga->image = $imagePath;
        }
        $manga->update();
        if($request->tags) {
            $manga->tags()->syncWithoutDetaching($request->tags);
        }
        if($request->categories) {
            $manga->categories()->syncWithoutDetaching($request->categories);
        }

        if($manga_old == $request->title) {
            session()->flash('success', 'Manga "'.$manga_old.'" Updated Successfully');
        } else {
            session()->flash('success', 'Manga "'.$manga_old.'" Updated to "'.$manga->title.'"');
        } 

        return redirect(route('manga.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manga = Manga::findOrFail($id);

        $manga_title = $manga->title;
        $volume_count = $manga->volumes->count() > 0 ? $manga->volumes->count() : 0;

        $manga->delete();
        session()->flash('success', 'Manga "'.$manga_title.'" and '.$volume_count.' volume(s) have been deleted');

        return redirect(route('manga.index'));
    }
}
