@extends('layouts.app')

@section('content')
    <div class="card bg-dark text-white">
        <div class="card-header">Mangas <a href=" {{route('manga.create')}} " class="float-right btn btn-secondary btn-sm">Add New</a></div>
        <div class="card-body">
            @if(count($mangas) > 0)
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Volumes</th>
                            <th scope="col">TagCount</th>
                            <th scope="col">CatCount</th>
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
                                <td>
                                    <div class="float-right">
                                        <a href=" {{route('manga.edit', $manga->id)}} " class="btn btn-primary btn-sm"> More Details </a> 
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
                {{ $mangas->links() }}
            </div>
    </div>
@endsection

@section('script')

@endsection