<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manga;
use App\Volume;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //paginate volumes and send to index view
        $volumes = Volume::paginate(6)->onEachSide(1);
        return view('volumes.index')->with('volumes', $volumes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all mangas and redirect to the create view
        $mangas = Manga::all();
        return view('volumes.create')->with('mangas', $mangas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
            This piece needs validation which i will focus on later,
            Right now i wanted to get the functionality working!
        */
        //get last key of request object to calculate how many volumes to insert
        $manga = $request->manga;
        $requestobject = $request->all();
        end($requestobject);
        $lastkey1 = key($requestobject);
        $lastkey = substr("$lastkey1", -1);
        $volumes = array();
        //create multidimensional array for each of the volumes with correct meta
        for($i = 0; $i <= $lastkey; $i++) {
            if($i == 0) {
                //validate first volume entry
                $this->validate($request, [
                    'title' => ['required'],
                    'manga' => ['required'],
                    'price' => ['required', 'max:150'],
                    'stock' => ['required', 'min:1'],
                    'discount' => ['max:90']
                ]);
                if(isset($request->image)) {
                    $imagePath = request('image')->store('/manga_cover', 'public');
                }
                $volumes[] = array(
                    'volume' => $request->input('title'),
                    'manga_id' => $manga,
                    'image' => $imagePath,
                    'price' => $request->input('price'),
                    'stock' => $request->input('stock'),
                    'discount' => $request->input('discount'),
                );
            } else {
                //dynamically validate added fields
                $this->validate($request, [
                    'title-'.$i => ['required'],
                    'price-'.$i => ['required', 'max:150'],
                    'stock-'.$i => ['required', 'min:1'],
                    'discount-'.$i => ['max:90']
                ]);
                $imagePath = request('image-'.$i)->store('/manga_cover', 'public');
                if(isset($imagePath)) {
                    $imagePath1 = $imagePath;
                }
                $volumes[] = array(
                    'volume' => $request->input('title-'.$i),
                    'manga_id' => $manga,
                    'image' => isset($imagePath1) ? $imagePath1 : '',
                    'price' => $request->input('price-'.$i),
                    'stock' => $request->input('stock-'.$i),
                    'discount' => $request->input('discount-'.$i),
                );
            }
        }
        //check if volumes is empty or not
        if(!empty($volumes)) {
            $v = Volume::insert($volumes);
        }
        //redirect back to volumes.index view with success flash message
        return redirect(route('volume.index'))->with('success', 'Successfully added '.$i.' Volume(s)');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
