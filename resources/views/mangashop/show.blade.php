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
                    <h4 class="text-danger float-right">Out Of Stock</h4>
                @else
                <a id="add" role="button" class="cursor-pointer float-right mb-3" onclick="addtocart( {{$volume->id}} )">
                        <i class="fas fa-cart-plus text-white fa-2x"></i>
                    </a>
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
                                                                <div class="hoveroverimagedark">
                                                                    <a href=" {{route('mangashop.show', $volume1->id)}} " class="text-reset"><img src="
                                                                    {{isset($volume1->image) ? 
                                                                    asset("storage/$volume1->image") : 
                                                                    asset("storage/$volume1->manga()->image")}}" 
                                                                    class="carousel-cell-image"> </a>  
                                                                    <div class="add-to-cart">
                                                                        <a id="add" role="button" class="cursor-pointer" onclick="addtocart( {{$volume1->id}} )">
                                                                            <i class="fas fa-cart-plus text-white fa-2x"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
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
    <!-- Place holder for reviews later -->
    <div class="container text-white pt-5">
            <h3 class="section-title title_center">
                    <span class="p-5">{{$volume->manga->title}} {{$volume->volume}} Reviews</span>
                </h3>
                @php($counter=0)
                <div class="row">
                    @if(isset($reviews))
                        @foreach($reviews as $review)
                            <div class="col">
                                <blockquote  class="blockquote">
                                    <div class="mb-0"> {!!$review->review!!} </div>
                                    <footer class="blockquote-footer"> {!!$review->getUser()->name!!}
                                        @auth
                                            @if(auth()->user()->id === $review->getUser()->id)
                                                <button class="btn btn-secondary btn-sm float-right">Edit</button>
                                            @endif
                                        @endauth
                                    </footer>
                                </blockquote>
                            </div>
                            @php($counter++)
                            @if($counter == 2)
                            </div>
                            <div class="row">
                                @php($counter = 0)
                            @endif
                        @endforeach
                    @endif
                </div>
    </div>
    <hr>
    @auth
    <div class="container pt-3">
                <div class="card-body form-dark">
                        <form action=" {{route('review.store', $volumeid)}} " method="POST">
                            @csrf
                            <input type="hidden" name="userid" value=" {{auth()->user()->id}} ">
                            <div class="form-group row">
                                <label for="review" class="col-md-2 col-form-label text-md-right">{{ __('Review') }}</label>
                                <div class="col-md-8 dark-trix">
                                    <input id="review" 
                                        type="hidden" 
                                        name="review" 
                                        class="form-control @error('review') is-invalid @enderror" 
                                        value="{{ old('review')}}">
                                    <trix-editor input="review"></trix-editor>
                
                                    @error('review')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-7 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
    </div>
    @endauth
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
    <script>
        function addtocart(id) {
                $.ajax({
                url: '/addtocart/'+id,
                success: function (response) {
                        location.reload();
                }
                });
            };
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
@endsection