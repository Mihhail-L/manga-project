@extends('layouts.app')

@section('content')
   @if(isset($filter))
    @include('inc.filter')
   @else 
    <div class="container">
        <div class="row">
            <div class="col-md-2 border-thing text-left">
                @include('inc.sidebar')
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
                                            <a id="add" role="button" class="cursor-pointer" onclick="addtocart( {{$volume->id}} )"><i class="fas fa-cart-plus text-primary"></i></a>
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