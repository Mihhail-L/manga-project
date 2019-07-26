@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-11"><h4>Update Manga: {{$manga->title}} </h4> </div>
                    <div class="col-md-1"><a href=" {{route('manga.show', $manga->id)}} " class="btn btn-secondary btn-sm float-right">Back</a></div>
                </div>
            </div>
            <div class="card-body form-dark">
                <form action=" {{ route('manga.update', $manga->id)}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Manga Title') }}</label>
                        <div class="col-md-7">
                            <input id="title" 
                                type="text" 
                                placeholder="Manga Title" 
                                class="form-control @error('title') is-invalid @enderror" 
                                name="title" 
                                value="{{ $manga->title }}" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Manga Author') }}</label>
                        <div class="col-md-7">
                            <input id="author" 
                                type="text" 
                                placeholder="Manga Author" 
                                class="form-control @error('author') is-invalid @enderror" 
                                name="author" 
                                value="{{ $manga->author }}" autofocus>

                            @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Manga Description') }}</label>
                        <div class="col-md-7 dark-trix">
                            <input id="description" 
                                type="hidden" 
                                name="description" 
                                class="form-control @error('description') is-invalid @enderror" 
                                value="{{ $manga->description }}">
                            <trix-editor input="description"></trix-editor>
    
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Manga Start Date') }}</label>
                        <div class="col-md-7">
                                <input 
                                type="text" 
                                class="form-control" 
                                name="start_date" 
                                id="start_date" value=" {{$manga->start_date}} ">
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('Manga End Date(optional)') }}</label>
                        <div class="col-md-7">
                                <input 
                                type="text" 
                                class="form-control" 
                                name="end_date" 
                                id="end_date" value=" {{$manga->end_date}} ">

                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bundlePrice" class="col-md-4 col-form-label text-md-right">{{ __('Manga Bundled Price(optional)') }}</label>
                        <div class="col-md-7">
                                <div class="input-group">
                                    <span class="input-group-addon p-2">$</span>
                                    <input 
                                        type="text" 
                                        min="5" step="1" 
                                        data-number-to-fixed="2" data-number-stepfactor="100" 
                                        class="form-control currency" name="bundle_price"
                                        id="bundlePrice"
                                        placeholder = "Set Custom Bundle Price currently: "
                                        value="
                                        @if(empty($manga->bundle_price))
                                            {{strip_tags($manga->volumes->sum('price'))}}
                                        @else 
                                            {{$manga->bundle_price}}
                                        @endif">
                                </div>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if(isset($manga->image))
                    <div class="form-group">
                      <label for="img" class="col-md-4 col-form-label text-md-right">Current Manga Cover</label>
                      <div class="col-md-8 float-right p-2" id="img">
                            <a href=" {{asset("storage/$manga->image")}} " class="text-muted text-sm" id="covermanga"> {{asset("storage/$manga->image")}} </a>
                      </div>
                    </div>
                    @endif
                    <div class="form-group row files">
                        <label class="col-md-4 col-form-label text-md-right">Change Manga Cover Image </label>
                        <div class="col-md-7">
                            <input type="file" class="form-control-file" name="image" id="image">
                            <span class="text-muted text-sm filename"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tags" class="col-md-4 col-form-label text-md-right">Change Tags </label>
                        <div class="col-md-7">
                             <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}"
                                        @if($manga->hasTag($tag->id))
                                            selected
                                        @endif
                                        >
                                        {{$tag->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="categories" class="col-md-4 col-form-label text-md-right">Change Categories </label>
                            <div class="col-md-7">
                                 <select name="categories[]" id="categories" class="form-control categories-selector" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"
                                            @if($manga->hasCat($category->id))
                                                selected
                                            @endif
                                            >
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                               {{ isset($manga) ? 'Save' : 'Create' }}
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-powertip/1.2.0/jquery.powertip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script> 
        // mouse-on examples
        var imagesource = document.getElementById("covermanga").href;
        $('#img a').data('powertip', $([
            '<img src="'+imagesource+'" />'].join('\n')));
        $('#img a').powerTip({
            followMouse: true
        });
        
        $(document).ready(function() {
            var bundledprice = $('#bundlePrice').val();
            bundledprice = bundledprice.trim();
            $('#bundlePrice').val(bundledprice);
        });
        $('#bundlePrice').click(function() { 
            $(this).prop('type', 'number');
        });
        flatpickr('#start_date', {
            enableTime: false,
        });
        flatpickr('#end_date', {
            enableTime: false,
        });
        $(document).ready(function() {
            $('#tags').select2();
        });
        $(document).ready(function() {
            $('#categories').select2();
        });
        $(function() {
            $("input:file").change(function (){
                var fileName = $(this).val();
                $(".filename").html(fileName);
            });
        });
    </script>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-powertip/1.2.0/css/jquery.powertip-dark.min.css">
@endsection
