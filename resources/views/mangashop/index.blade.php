@extends('layouts.app')

@section('content')
   @if(isset($filter))
    @include('inc.filter')
   @else 
    <div class="container">
        <div class="row">
            <div class="col-md-2 border-thing text-left">
                <h2 class="text-white">Categories</h2>
                <button class="btn btn-secondary" data-toggle="collapse" type="button" data-target="#categoriesToggler" aria-expanded="false" id="catCollapse">Show Categories </button>
                <ul class="collapse float-left list-group" id="categoriesToggler">
                    @foreach ($categories as $category)
                        @if($category->mangas->count() > 0)
                            <a href="{{route('mangashop.category', $category->id)}}" class="reset-text text-white">
                                <li class="categories-btn w-100 list-group-item ">
                                    <div class="mt-1">{{$category->name}}</div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
                <hr>
                <h2 class="text-white">Manga</h2>
                <button class="btn btn-secondary" data-toggle="collapse" type="button" data-target="#mangaToggler" aria-expanded="false" id="catCollapse">Show Manga </button>
                <ul class="collapse float-left list-group" id="mangaToggler">
                    @foreach ($mangas as $manga)
                        @if($manga->volumes->count() > 0)
                            <a href="{{route('mangashop.manga', $manga->id)}}" class="reset-text text-white">
                                <li class="categories-btn w-100 list-group-item ">
                                    <div class="mt-1">{{$manga->title}}</div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10 text-center text-white">
                @if($volumes->count() > 0)
                    <div class="row p-3">
                        @foreach($volumes as $volume)
                                <div class="inner-wrap-shop my-2 mr-2">
                                    <a href=" {{route('mangashop.show', $volume->id)}} " class="text-reset"><img src="
                                    {{isset($volume->image) ? 
                                    asset("storage/$volume->image") : 
                                    asset("storage/$volume->manga()->image")}}" 
                                    class="carousel-cell-image"> </a>  
                                    <div class="text-center">    
                                        <h5 class=" pt-2"> Manga </h5>
                                        <div class="tx-div"></div>
                                        <a href=" {{route('mangashop.show', $volume->id)}} " class="text-reset"> <p> {{$volume->manga->title}} {{$volume->volume}} </p>  </a>
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
                        @endforeach
                    </div>
                @else 
                    <h1 class="text-white">No Manga Yet</h1>
                @endif
                <div class="d-flex justify-content-center">
                        {{ $volumes->links() }}
                    </div>
            </div>
        </div>
    </div>
   @endif
@endsection

@section('css')

@endsection

@section('scripts')
<script>
        $('#categoriesToggler').on('hidden.bs.collapse', function () {
            document.getElementById('catCollapse').innerHTML = "Show Categories";
        });
        $('#categoriesToggler').on('shown.bs.collapse', function () {
            document.getElementById('catCollapse').innerHTML = "  Hide Categories  ";
        });
        $('#mangaToggler').on('hidden.bs.collapse', function () {
            document.getElementById('mangaCollapse').innerHTML = "Show Manga";
        });
        $('#mangaToggler').on('shown.bs.collapse', function () {
            document.getElementById('mangaCollapse').innerHTML = "  Hide Manga  ";
        });
        $('#tagToggler').on('hidden.bs.collapse', function () {
            document.getElementById('tagCollapse').innerHTML = "Show Tags";
        });
        $('#tagToggler').on('shown.bs.collapse', function () {
            document.getElementById('tagCollapse').innerHTML = "  Hide Tags  ";
        });
    </script>
@endsection