@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-11" id="volume-manga"><h4>Create New Volume(s)</h4> </div>
                    <div class="col-md-1"><a href="/volume" class="btn btn-secondary btn-sm float-right">Back</a></div>
                </div>
            </div>
            <div class="card-body form-dark">
                <form action=" {{route('volume.store')}} " method="POST" id="volumeForm">
                    @csrf
                      <div class="tab">
                        <div class="form-group row">
                            <label for="manga" class="col-md-4 col-form-label text-md-right">{{ __('Choose Manga') }}</label>
                            <div class="col-md-7">
                                <select name="manga" id="manga" class="form-control">
                                    @foreach($mangas as $manga)
                                        <option value="{{$manga->id}}">
                                            {{$manga->title}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('manga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                            <div id="field">
                                    <div id="field0">
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
                                                value="" min="5" step="1" 
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
                                                    value="" min="2" step="1" max="90"
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
                                            <input type="number" name="stock" id="stock"
                                                value="" min="1" step="1" 
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

                        <div class="form-group row files">
                            <label class="col-md-4 col-form-label text-md-right">Upload Volume Cover</label>
                            <div class="col-md-7">
                                <input type="file" class="form-control-file" name="image" id="image">
                                <span class="text-muted text-sm filename"></span>
                            </div>
                        </div>
                    </div>
                </div>
                       <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button class="btn btn-primary" id="add-more" name="add-more">
                                    Add More
                                </button>
                            </div>
                        </div>
                        <br><br>

                    </div>
                    <div style="overflow:auto;">
                            <button type="button" id="prevBtn" class="btn btn-secondary float-left" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" class="btn btn-primary float-right" onclick="nextPrev(1)">Next</button>
                    </div>
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    /*
        Found the multi-step form at codepen when looking on how to do it,  
        not to waste time i just copied it over. 
    */
    // Multi-Step Form 
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the crurrent tab
    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            var btn = document.getElementById("nextBtn");
            document.getElementById("nextBtn").innerHTML = "Submit";
            //document.getElementById("nextBtn").type = "submit";
            $("#nextBtn").click(function() {
                $("#volumeForm").submit();
            });
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }
    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    //Dynamically add forms for multi insert of volumes
    var next = 0;
        $("#add-more").click(function(e){
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn = '<div id="field'+ next +'" name="field'+ next +'"> <br id="brk'+next+'"><hr id="linelol'+next+'"><div class="form-group row"> <label for="title" class="col-md-4 col-form-label text-md-right">Volume title/number</label> <div class="col-md-7"> <input id="title" type="text" placeholder="Volume title/number" class="form-control" name="title-'+next+'" value="" autofocus> </div> </div> <div class="form-group row"> <label for="price" class="col-md-4 col-form-label text-md-right">Volume Price</label> <div class="col-md-7"> <div class="input-group"> <span class="input-group-addon p-2">$</span> <input type="number" name="price-'+next+'" id="price" value="" min="5" step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" placeholder=" Volume Price"/> </div> </div> </div> <div class="form-group row"> <label for="discount" class="col-md-4 col-form-label text-md-right">Volume Discount(optional)</label> <div class="col-md-7"> <div class="input-group"> <span class="input-group-addon p-2">%</span> <input type="number" name="discount-'+next+'" id="discount" value="" min="2" step="1" max="90" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" placeholder="Volume Discount(min=2%:max=90%)"/> </div> </div> </div><div class="form-group row"> <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Volume Stock') }}</label> <div class="col-md-7"> <div class="input-group"> <span class="input-group-addon p-2">#</span> <input type="number" name="stock-'+next+'" id="stock" value="" min="1" step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" placeholder=" Volume Stock"/> </div> </div> </div> <div class="form-group row files"> <label class="col-md-4 col-form-label text-md-right">Upload Volume Cover</label> <div class="col-md-7"> <input type="file" class="form-control-file" name="image-'+next+'" id="image"> <span class="text-muted text-sm filename"></span> </div> </div> </div>';
            var newInput = $(newIn);
            var removeBtn = '<div class="form-group row mb-0"><div class="col-md-8 offset-md-5"><button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div></div></div><div id="field">';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source',$(addto).attr('data-source'));
            $("#count").val(next);  
            
                $('.remove-me').click(function(e){
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length-1);
                    var fieldID = "#field" + fieldNum;
                    var breakline = "#brk" + fieldNum;
                    var linelol = "#linelol" + fieldNum;
                    $(this).remove();
                    $(fieldID).remove();
                    $(breakline).remove();
                    $(linelol).remove();
                });
        });
</script>
@endsection