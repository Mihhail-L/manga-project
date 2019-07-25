@extends('layouts.app')

@section('content')
<div class="hero-container">
    <div class="hero-image">
        <div class="hero-text">
            <h1 style="font-size:80px">Welcome To MangaMan</h1>
            <p style="font-size:40px">We Sell Manga</p>
            <button> <a href="/mangashop" class="text-reset text-uppercase" style="text-decoration: none;"> Browse </a></button>
        </div>
    </div>
</div>


<div class="container text-white">
    <div class="carousel-stuff row">
            <div class="large-12 columns">
                <h3 class="section-title">Featured Manga</h3>
                    <div class="carousel" data-flickity='{
                        "cellAlign": "left",
                        "wrapAround": true,
                        "percentPosition": true,
                        "imagesLoaded": true,
                        "pageDots": false,
                        "selectedAttraction" : 0.05,
                        "friction": 0.6,
                        "contain": true,
                        "prevNextButtons": false
                        }'> 
                        @foreach($mangas as $manga) 
                            @foreach($manga->volumes as $volume)
                                <div class="carousel-cell">
                                    <div class="inner-wrap">
                                        <a href="" class="text-reset"><img src="
                                        {{isset($volume->image) ? 
                                        asset("storage/$volume->image") : 
                                        asset("storage/$manga->image")}}" 
                                        class="carousel-cell-image"> </a>  
                                        <div class="text-center">    
                                            <h5 class=" pt-2"> Manga </h5>
                                            <div class="tx-div"></div>
                                            <a href="" class="text-reset"> <p> {{$manga->title}} {{$volume->volume}} </p>  </a>
                                            <span class="price"> 
                                                @if(isset($volume->discount))
                                                    <del> <span>${{$volume->price}}</span> </del><br>
                                                    <ins> <span>${{round((1 - $volume->discount/100) * $volume->price, 2)}}</span> </ins>
                                                @else
                                                    ${{$volume->price}} 
                                                @endif
                                            </span>
                                        </div>
                                    </div>                   
                                </div>
                            @endforeach
                        @endforeach
                    </div>
            </div>
    </div>
    <h3 class="section-title title_center">
        <span class="p-5">Browse categories</span>
    </h3>
        <div class="row">
            @php ($counter = 0)
            @foreach($categories as $category)
                @if($counter < 8)
                <div class="category-images w-25 mb-3">
                        <a href="" class="text-reset">
                            <img src="http://mangaman.test/storage/website-images/abstract_category_button.png">
                            <h5 class="category-text"> {{$category->name}} <div class="tx-div"></div></h5>
                        </a> 
                    </div>
                @endif
                @php($counter++)
            @endforeach
        </div>
    <h3 class="section-title title_center">
        <span class="p-5">Customer Reviews</span>
    </h3>
    <div class="row">
        <div class="col">
            <blockquote  class="blockquote">
                <p class="mb-0">For 50 years, WWF has been protecting the future of nature. The world's leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>
                <footer class="blockquote-footer">From WWF's website</footer>
            </blockquote>
        </div>
        <div class="col">
            <blockquote class="blockquote">
                <p class="mb-0">For 50 years, WWF has been protecting the future of nature. The world's leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>
                <footer class="blockquote-footer">From WWF's website</footer>
            </blockquote>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <blockquote  class="blockquote">
                <p class="mb-0">For 50 years, WWF has been protecting the future of nature. The world's leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>
                <footer class="blockquote-footer">From WWF's website</footer>
            </blockquote>
        </div>
        <div class="col">
            <blockquote class="blockquote">
                <p class="mb-0">For 50 years, WWF has been protecting the future of nature. The world's leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>
                <footer class="blockquote-footer">From WWF's website</footer>
            </blockquote>
        </div>
    </div>
</div>
<footer class="manga-footer text-center text-white">
    <p class="pt-4">&copy; MangaMan 2019</p>
</footer>
@endsection

<!-- This is for later scripts and custom css imports -->
@section('scripts')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection