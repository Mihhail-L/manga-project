@extends('layouts.app')

@section('content')
    <div class="card bg-dark text-white">
        <div class="card-header">Volumes <a href=" {{route('volume.create')}} " class="float-right btn btn-secondary btn-sm">Add New</a></div>
        <div class="card-body">
            @if(count($volumes) > 0)
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Volume Title</th>
                            <th scope="col">Manga</th>
                            <th scope="col">Stock</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volumes as $volume)
                            <tr>
                                <th scope="row"> {{$volume->id}} </th>
                                <td> {{$volume->volume}} </td>
                                <td> {{$volume->manga->title}} </td>
                                <td> {{isset($volume->stock) ? $volume->stock : '0'}} </td>
                                <td>
                                    <div class="float-right">
                                        <a href=" {{route('volume.edit', $volume->id)}} " class="btn btn-primary btn-sm"> More Details </a> 
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
            <h5>No volumes yet</h5>
            @endif
        </div>
        <div class="d-flex justify-content-center">
                {{ $volumes->links() }}
            </div>
    </div>
@endsection

@section('script')

@endsection