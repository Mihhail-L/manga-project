@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-10" id="volume-manga"><h4>Create New Volume(s)</h4> </div>
                    <div class="col-md-2">
                        <form action=" {{route('volume.destroy', $volume->id)}} " method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm float-right">Delete Volume</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body form-dark">
                <form action=" {{route('volume.update', $volume->id)}} " method="POST" id="volumeForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Volume title/number') }}</label>
                            <div class="col-md-7">
                                <input id="title" 
                                    type="text" 
                                    placeholder="Volume title/number" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    name="title" 
                                    value="{{ isset($volume) ? $volume->volume : '' }}" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Volume Price') }}</label>
                            <div class="col-md-7">
                                    <div class="input-group">
                                            <span class="input-group-addon p-2">$</span>
                                            <input type="number" name="price" id="price"
                                                value="{{ isset($volume) ? $volume->price : '0' }}" min="5" step="1" 
                                                data-number-to-fixed="2" data-number-stepfactor="100" 
                                                class="form-control currency" placeholder=" Volume Price"/>
                                    </div>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Volume Discount(optional)') }}</label>
                                <div class="col-md-7">
                                        <div class="input-group">
                                                <span class="input-group-addon p-2">%</span>
                                                <input type="number" name="discount" id="discount"
                                                    value="{{ isset($volume) ? $volume->discount : '0' }}" min="2" step="1" max="90"
                                                    data-number-to-fixed="2" data-number-stepfactor="100" 
                                                    class="form-control currency" placeholder="Volume Discount(min=2%:max=90%)"/>
                                        </div>
        
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Volume Stock') }}</label>
                            <div class="col-md-7">
                                    <div class="input-group">
                                            <span class="input-group-addon p-2">#</span>
                                            <input type="text" name="stock" id="stock"
                                                value="{{ isset($volume) ? $volume->stock : '0' }} " min="1" step="1" 
                                                data-number-to-fixed="2" data-number-stepfactor="100" 
                                                class="form-control currency" placeholder=" Volume Stock"/>
                                    </div>

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if(isset($volume->image))
                        <div class="form-group">
                            <label for="img" class="col-md-4 col-form-label text-md-right">Current Volume Cover</label>
                            <div class="col-md-8 float-right p-2" id="img">
                                  <a href=" {{asset("storage/$volume->image")}} " class="text-muted text-sm" id="covermanga"> {{asset("storage/$volume->image")}} </a>
                            </div>
                          </div>
                        <div class="form-group row files">
                            <label class="col-md-4 col-form-label text-md-right">Update Volume Cover</label>
                            <div class="col-md-7">
                                <input type="file" class="form-control-file" name="image" id="image">
                                <span class="text-muted text-sm filename"> {{$volume->image}} </span>
                            </div>
                        </div>
                        @else 
                        <div class="form-group row files">
                            <label class="col-md-4 col-form-label text-md-right">Upload Volume Cover</label>
                            <div class="col-md-7">
                                <input type="file" class="form-control-file" name="image" id="image">
                                <span class="text-muted text-sm filename"></span>
                            </div>
                        </div>
                        @endif
                        <div style="overflow:auto;">
                                <a href=" {{url()->previous()}} " class="btn btn-secondary float-left">Back</a>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                    </div>
                </div>
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-powertip/1.2.0/jquery.powertip.min.js"></script>
<script>
            // mouse-on examples
            var imagesource = document.getElementById("covermanga").href;
        $('#img a').data('powertip', $([
            '<img src="'+imagesource+'" />'].join('\n')));
        $('#img a').powerTip({
            followMouse: true
        });
        $(document).ready(function() {
            var stock = $('#stock').val();
            stock = stock.trim();
            $('#stock').val(stock);
        });
        $('#stock').click(function() { 
            $(this).prop('type', 'number');
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-powertip/1.2.0/css/jquery.powertip-dark.min.css">
@endsection