@extends('layouts.app')

@section('content')
    <div class="card bg-dark text-white">
        <div class="card-header">Categories <a href=" {{route('category.create')}} " class="float-right btn btn-secondary btn-sm">Add New</a></div>
        <div class="card-body">
            @if(count($categories) > 0)
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row"> {{$category->id}} </th>
                                <td> {{$category->name}} </td>
                                <td>
                                    <div class="float-right">
                                        <a href=" {{route('category.edit', $category->id)}} " class="btn btn-primary btn-sm"> Edit </a> 
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}}, '{{$category->name}}')">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog text-dark" role="document">
                      <form method="POST" action="" id="deleteCategoryForm">
                          @method('DELETE')
                          @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
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
            <h5>No categories yet</h5>
            @endif
        </div>
        <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
    </div>
@endsection

<!-- Javascript scripts go here -->
@section('scripts')
    <script>
        function handleDelete(id, name) {
            var form = document.getElementById('deleteCategoryForm');
            document.getElementById("delete-paragraph").innerHTML = "Are you sure you want to delete category: "+name+"?";
            form.action = '/category/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection