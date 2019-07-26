@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark text-white">
                <div class="card-header">Tags <a href=" {{route('tags.create')}} " class="float-right btn btn-secondary btn-sm">Add New</a></div>
                <div class="card-body">
                    @if(count($tags) > 0)
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <th scope="row"> {{$tag->id}} </th>
                                        <td> {{$tag->name}} </td>
                                        <td>
                                            <div class="float-right">
                                                <a href=" {{route('tags.edit', $tag->id)}} " class="btn btn-primary btn-sm"> Edit </a> 
                                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}}, '{{$tag->name}}')">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog text-dark" role="document">
                            <form method="POST" action="" id="deleteTagForm">
                                @method('DELETE')
                                @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center text-bold" id="delete-paragraph">
                                                
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Yes, I'm sure</button>
                                        </div>
                                    </div>
                            </form>
                            </div>
                        </div>
                    @else 
                    <h5>No tags yet</h5>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                        {{ $tags->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Javascript scripts go here -->
@section('scripts')
    <script>
        function handleDelete(id, name) {
            var form = document.getElementById('deleteTagForm');
            document.getElementById("delete-paragraph").innerHTML = "Are you sure you want to delete Tag: "+name+"?";
            form.action = '/tags/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection