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
        //substr("testers", -1); // returns "s"
        $manga = $request->manga;
        $requestobject = $request->all();
        end($requestobject);
        $lastkey1 = key($requestobject);
        $lastkey = substr("$lastkey1", -1);

        for($i = 0; $i <= $lastkey; $i++) {
            if($i == 0) {
                $volumes = array();
                $volumes[] = array(
                    'volume' => $request->input('title'),
                    'manga_id' => $manga,
                    'image' => $request->input('image'),
                    'price' => $request->input('price'),
                    'discount' => $request->input('discount'),
                );
            } else {
                $volumes[] = array(
                    'volume' => $request->input('title-'.$i),
                    'manga_id' => $manga,
                    'image' => $request->input('image-'.$i),
                    'price' => $request->input('price-'.$i),
                    'discount' => $request->input('discount-'.$i),
                );
            }
        }
        // $v = new Volume;
        $v = Volume::insert($volumes);

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
