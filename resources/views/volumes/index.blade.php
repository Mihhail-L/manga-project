@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark text-white">
                <div class="card-header">Volumes <a href=" {{route('volume.create')}} " class="float-right btn btn-secondary btn-sm">Add New</a></div>
                <div class="card-body">
                    @if(count($volumes) > 0)
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
                                        <th scope="row"> {{$volume->id}} </td>
                                        <td> <a href=" {{route('manga.show', $volume->manga->id) }} "> {{$volume->manga->title}} </a> {{$volume->volume}} </td>
                                        <td> ${{$volume->price}} </td>
                                        <td> {!! $volume->discount > 25 ? '<span class="text-danger">'.$volume->discount.'%</span>' : $volume->discount.'%'!!} </td>
                                        <td> ${{round((1 - $volume->discount/100) * $volume->price, 2)}} </td>
                                        <td> {!!$volume->stock < 10 ? '<span class="text-danger">'.$volume->stock.'</span>' : $volume->stock!!} </td>
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
                    <h5>No volumes yet</h5>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                        {{ $volumes->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection