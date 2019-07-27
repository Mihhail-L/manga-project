@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <div class="row">
            <div class="col-md-4 border-thing-shop">
                <img class="shop-item-image" src=" {{isset($volume->image) ? asset("/storage/$volume->image") : asset("/storage/$volume->manga->cover_image")}} " alt=" {{$volume->manga->title}}  {{$volume->volume}} ">
            </div>
            <div class="col-md-8">
                <h2> {{$volume->manga->title}} {{$volume->volume}} </h2>
                @if($volume->stock == 0)
                    <button class="btn float-right btn-secondary disabled">Place holder</button>
                @else
                    <button class="btn btn-success float-right">Place holder</button>
                @endif
                <h5> Manga Author: {{$volume->manga->author}} </h5>
                <h5>Price: <span class="price" style="font-size:20px;"> 
                    @if($volume->discount > 0) 
                        <del> <span>${{$volume->price}}</span> </del>
                        <ins> <span>${{round((1 - $volume->discount/100) * $volume->price, 2)}}</span> </ins>
                    @else 
                        ${{$volume->price}}
                    @endif
                </span></h5>
                    @if($volume->stock > 10)
                        <h5>In Stock: <span style="color:green;">{{ $volume->stock }}</span></h5>
                    @elseif($volume->stock == 0)
                    <h4 class="text-danger">Out of Stock</h4>
                    @else
                        <h5>In Stock: <span style="color:red;">{{ $volume->stock }}</span></h5>
                    @endif
                <br>
                <h4>Synopsis:</h4>
                <hr>
                <blockquote class="blockquote">
                    <p class="mb-0">
                        {!! $volume->manga->description !!}
                    </p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="container text-white pt-5">
        <div class="carousel-stuff row">
                    <div class="large-12 columns">
                        <h3 class="section-title">All Available "{{$volume->manga->title}}" Volumes</h3>
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
                                @foreach($volume->manga->volumes as $volume1)
                                        @if($volume1->stock > 0)
                                            <div class="carousel-cell">
                                                <div class="inner-wrap">
                                                    <a href=" {{route('mangashop.show', $volume1->id)}} " class="text-reset"><img src="
                                                    {{isset($volume1->image) ? 
                                                    asset("storage/$volume1->image") : 
                                                    asset("storage/$volume1->manga->image")}}" 
                                                    class="carousel-cell-image"> </a>  
                                                    <div class="text-center">    
                                                        <h5 class=" pt-2"> Manga </h5>
                                                        <div class="tx-div"></div>
                                                        <a href=" {{route('mangashop.show', $volume1->id)}} " class="text-reset"> <p> {{$volume1->manga->title}} {{$volume1->volume}} </p>  </a>
                                                        <span class="price"> 
                                                            @if(isset($volume1->discount))
                                                                <del> <span>${{$volume1->price}}</span> </del><br>
                                                                <ins> <span>${{round((1 - $volume1->discount/100) * $volume1->price, 2)}}</span> </ins>
                                                            @else
                                                                ${{$volume1->price}} 
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>                   
                                            </div>
                                        @endif
                                @endforeach
                            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection