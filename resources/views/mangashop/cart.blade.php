@extends('layouts.app')


@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <table id="cart" class="table table-hover table-condensed text-white">
                                <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                         
                                <?php $total = 0 ?>
                         
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                         
                                        <?php $total += $details['discount'] > 0 ? round((1 - $details['discount']/100) * $details['price'], 2)* $details['quantity'] : $details['price'] * $details['quantity'] ?>
                         
                                        <tr> 
                                            <td data-th="Product">
                                                <div class="row">
                                                    <div class="col-sm-3 hidden-xs">
                                                            <a href=" {{route('mangashop.show', $id)}} ">
                                                                <img src="{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/>
                                                            </a>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <a href=" {{route('mangashop.show', $id)}} " class="text-reset">
                                                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-th="Price">${{$details['discount'] > 0 ? round((1 - $details['discount']/100) * $details['price'], 2) : $details['price'] }}</td>
                                            <td data-th="Quantity">
                                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" style="max-width: 21% !important;" />
                                            </td>
                                            <td data-th="Subtotal">${{ $details['discount'] > 0 ? round((1 - $details['discount']/100) * $details['price'], 2) * $details['quantity'] : $details['price'] * $details['quantity'] }}</td>
                                            <td class="actions" data-th="">
                                                <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fas fa-sync-alt"></i></button>
                                                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                         
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <td class="hidden-xs"><strong class="text-center">Total ${{ $total }}</strong></td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                    </div>
                </div>  
            </div>
        </div>
</div>

@endsection

@section('css')

@endsection

@section('scripts')
    <script>
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
           var id = ele.attr("data-id");
 
            $.ajax({
                url: '/updatecart/'+id,
                method: "put",
                data: {_token: '{{ csrf_token() }}', quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
            var id = ele.attr("data-id");
 
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '/removefromcart/'+id,
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection