@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 border-thing text-left">
                <h2 class="text-white">Categories</h2>
                <button class="btn btn-secondary" data-toggle="collapse" type="button" data-target="#categoriesToggler" aria-expanded="false" id="catCollapse">Show Categories </button>
                <ul class="collapse float-left list-group" id="categoriesToggler">
                    @foreach ($categories as $category)
                        @if($category->mangas->count() > 0)
                            <a href="" class="reset-text text-white">
                                <li class="categories-btn w-100 list-group-item ">
                                    <div class="mt-1">{{$category->name}}</div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10 text-center">
                @if($volumes->count() > 0)
                    <div class="row">
                        @foreach($volumes as $volume)
                            
                        @endforeach
                    </div>
                @else 
                    <h1 class="text-white">No Manga Yet</h1>
                @endif
            </div>
        </div>
    </div>
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
    </script>
@endsection