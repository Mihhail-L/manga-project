@extends('layouts.app')

@section('content')
    <div class="card bg-dark text-white">
        <div class="card-header">
            @if(isset($singular)) 
                Listing all details for manga: "{{$singular}}" and all volumes. 
                <a href=" {{route('manga.edit', $manga->id)}} " class="float-right btn btn-secondary btn-sm">Edit Manga</a>
            @elseif(count($mangas) > 0)
                Mangas 
                <a href=" {{route('manga.create')}} " class="float-right btn btn-secondary btn-sm">Add New</a>
            @endif
        </div>
        <div class="card-body">
            @if(isset($mangas) && count($mangas) > 0)
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Volumes</th>
                            <th scope="col">TagCount</th>
                            <th scope="col">CatCount</th>
                            <th scope="col">Total Stock</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mangas as $manga)
                            <tr>
                                <th scope="row"> {{$manga->id}} </th>
                                <td> {{$manga->title}} </td>
                                <td> {{$manga->volumes->count()}} </td>
                                <td> {{$manga->tags()->count()}} </td>
                                <td> {{$manga->categories()->count()}} </td>
                                <td> {{isset($manga->volumes->stock->sum()) ? $manga->volumes->stock->sum() : '0'}} </td>
                                <td>
                                    <div class="float-right">
                                        <a href=" {{route('manga.show', $manga->id)}} " class="btn btn-primary btn-sm"> More Details </a> 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(isset($singular))
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total price</th>
                            <th scope="col">Stock</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volumes as $volume)
                            <tr>
                                <td scope="row"> {{$volume->id}} </td>
                                <td>  {{$volume->volume}} </td>
                                <td> {{$volume->price}} </td>
                                <td> {{$volume->discount}} </td>
                                <td> {{round((1 - $volume->discount/100) * $volume->price, 2)}} </td>
                                <td> {{isset($volume->stock) ? $volume->stock : '0'}} </td>
                                <td> 
                                    <div class="float-right">
                                        <a href=" {{route('volume.edit', $volume->id)}} " class="btn btn-primary btn-sm">Edit Volume</a> 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
            <h5>No Mangas yet</h5>
            @endif
        </div>
        <div class="d-flex justify-content-center">
                @if(isset($mangas))
                    {{ $mangas->links() }}
                @elseif(isset($singular))
                    {{ $volumes->links() }}
                @endif
            </div>
    </div>
@endsection

@section('script')

@endsection