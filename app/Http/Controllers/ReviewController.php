<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manga;
use App\Volume;
use App\Tag;
use App\Category;
use App\User;
use App\Review;

class ReviewController extends Controller
{
    public function index() 
    {
        $reviews = Review::all();

        return view('review.index')->with('reviews', $reviews);
    }
    
    public function show($id) 
    {
        $review = Review::findOrFail($id);

        return view('review.show')->with('review', $review);
    }

    public function getVolumeReviews($id) 
    {
        //
    }

    public function store(Request $request, $volumeid) 
    {
        $review = new Review;
        $review->title = 'empty';
        $review->review = $request->review;
        $review->user_id = $request->userid;
        $review->volume_id = $volumeid;
        $review->rating = 0;
        $review->save();


        return redirect()->back()->with('success', 'Review posted successfully');
    }

    public function edit($reviewid)
    {
        $review = Review::findOrFail($reviewid);
        $edit = 'true';
        return view('review.create')
                ->with('volumeid', $volumeid)
                ->with('review', $review)
                ->with('edit', $edit);
    }

    public function update(Request $request, $reviewid) 
    {   
        $review = Review::findOrFail($reviewid);

    }

    public function destroy($reviewid) 
    {
        $review = Review::findOrFail($reviewid);

        $review->delete();

        return view();
    }
}
