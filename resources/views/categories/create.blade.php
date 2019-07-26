@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-11"><h4>Create New Category</h4> </div>
                    <div class="col-md-1"><a href="/category" class="btn btn-secondary btn-sm float-right">Back</a></div>
                </div>
            </div>
            <div class="card-body form-dark">
                <form action=" {{isset($category) ? route('category.update', $category->id) : route('category.store')}} " method="POST">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" 
                                type="text" 
                                placeholder="Category Name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{ isset($category) ? $category->name : '' }}" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                               {{ isset($category) ? 'Save' : 'Create' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection