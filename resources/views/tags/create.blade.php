@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-11"><h4>Create New Tag</h4> </div>
                    <div class="col-md-1"><a href="/tags" class="btn btn-secondary btn-sm float-right">Back</a></div>
                </div>
            </div>
            <div class="card-body form-dark">
                <form action=" {{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}} " method="POST">
                    @csrf
                    @if(isset($tag))
                        @method('PUT')
                    @endif
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tag Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" 
                                type="text" 
                                placeholder="Tag Name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{ isset($tag) ? $tag->name : '' }}" autofocus>

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
                               {{ isset($tag) ? 'Save' : 'Create' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection