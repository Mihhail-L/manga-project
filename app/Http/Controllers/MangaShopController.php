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
        $mangas = Manga::all();

        return view('mangashop.index')
                ->with('volumes', $volumes)
                ->with('categories', $categories)
                ->with('tags', $tags)
                ->with('mangas', $mangas);
    }

    public function show($id) {
        $volume = Volume::findOrFail($id);
        $manga = $volume->manga();
        $reviews = $volume->manga->reviews();
        // $manga_id = $volume->manga->id;
        // $mangass = Manga::find($manga_id);
        // $reviews = $mangass->reviews();

        return view('mangashop.show')->with('volume', $volume)->with('manga', $manga)->with('reviews', $reviews);
    }

    public function categoryFilter($id) {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $filter = 'category';
        $tags = Tag::all();
        $mangas = $category->mangas()->where('category_id', $id)->get();


        return view('mangashop.index')
                ->with('mangas', $mangas)
                ->with('filter', $filter);
        
    }

    public function tagFilter($id) {
        $tag = Tag::findOrFail($id);
        $filter = 'tag';
        $mangas = $tag->mangas()->where('tag_id', $id)->get();
        
        return view('mangashop.index')
                ->with('mangas', $mangas)
                ->with('filter', $filter);
    }

    public function mangaFilter($id) {
        $manga = Manga::findOrFail($id);
        $categories = Category::all();
        $filter = 'manga';
        $tags = Tag::all();
        //dd($manga);
        return view('mangashop.index')
                ->with('manga', $manga)
                ->with('categories', $categories)
                ->with('tags', $tags)
                ->with('filter', $filter);
    }
    /*
        CART LOGIC
    */
    public function addToCart($id) {
        $product = Volume::findOrFail($id);
 
        $cart = session()->get('cart');
 
        // check if cart is empty
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "name" => $product->manga->title. ' ' .$product->volume,
                        "quantity" => 1,
                        "price" => $product->price,
                        "discount" => $product->discount,
                        "photo" => isset($product->image) ? asset("/storage/{$product->image}") : asset("/storage/{$product->manga->image}"),
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if this product already exists inside the cart, update quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        // if new product is added to cart, push it to the session
        $cart[$id] = [
            "name" => $product->manga->title. ' ' .$product->volume,
            "quantity" => 1,
            "price" => $product->price,
            "discount" => $product->discount,
            "photo" => isset($product->image) ? asset("/storage/{$product->image}") : asset("/storage/{$product->manga->image}"),
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }   
    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function removeCart(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function viewCart() {
        return view('mangashop.cart');
    }
}
