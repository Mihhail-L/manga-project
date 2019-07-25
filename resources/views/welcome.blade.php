@extends('layouts.app')

@section('content')
<div class="hero-container">
    <div class="hero-image">
        <div class="hero-text">
            <h1 style="font-size:80px">Welcome To MangaMan</h1>
            <p style="font-size:40px">We Sell Manga</p>
            <button> <a href="/mangashop" class="text-reset" style="text-decoration: none;"> Browse Manga </a></button>
        </div>
    </div>
</div>


<div class="container text-white">
    <div class="carousel-stuff row">
            <div class="large-12 columns">
                    <div class="carousel" data-flickity='{
                        "cellAlign": "left",
                        "wrapAround": true,
                        "percentPosition": true,
                        "imagesLoaded": true,
                        "pageDots": false,
                        "selectedAttraction" : 0.05,
                        "friction": 0.6,
                        "contain": true
                        }'> 
                        @foreach($mangas as $manga) 
                            @foreach($manga->volumes as $volume)
                                <div class="carousel-cell inner-wrap">
                                    <img src="{{isset($volume->image) ? asset("storage/$volume->image") : asset("storage/$manga->image")}}" class="carousel-cell-image">        
                                    <p>{{ $manga->title }} {{$volume->volume}}  </p>                         
                                </div>
                            @endforeach
                        @endforeach
                    </div>
            </div>
    </div>
</div>
@endsection

<!-- This is for later scripts and custom css imports -->
@section('scripts')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection