<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm text-uppercase">
            <div class="container">
                <a class="navbar-brand pr-4 text-white" href="{{ url('/') }}">
                    <i class="text-white"> マンガマン</i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse pt-1" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/mangashop">MangaShop</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                            </a>
                            <div class="dropdown-menu bg-dark text-white" aria-labelledby="navbarDropdownMenuLink">
                                @foreach ($categories as $category)
                                    @if($category->mangas->count())
                                        <a class="dropdown-item reset-text text-white" href="/mangashop/category/{{$category->id}}"> {{$category->name}} </a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            MangaMan Info
                            </a>
                            <div class="dropdown-menu bg-dark text-white" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item reset-text text-white" href="/404"> Announcements </a>
                                <a class="dropdown-item reset-text text-white" href="/404"> Something Else </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sale
                            </a>
                            <div class="dropdown-menu bg-dark text-white" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item reset-text text-white" href="/discounts"> All Time Discount </a>
                                <a class="dropdown-item reset-text text-white" href="/thisweek"> This Week Specials </a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- CART -->

                        <div class="dropdown dropdown1 pr-3">
                            <button type="button" class="btn btn-secondary-cart nav-link" data-toggle="dropdown">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-secondary">{{ !empty(session('cart')) ? count(session('cart')) : 0 }}</span>
                            </button>
                            <div class="dropdown-menu menu1">
                                <div class="row total-header-section">
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-secondary">{{ !empty(session('cart')) ? count(session('cart')) : 0 }}</span>
                                    </div>
            
                                    <?php $total = 0 ?>
                                    @if(!empty(session('cart')))
                                    @foreach(session('cart') as $id => $details)
                                        <?php $total += $details['discount'] > 0 ? round((1 - $details['discount']/100) * $details['price'], 2)* $details['quantity'] : $details['price'] * $details['quantity'] ?>
                                    @endforeach
                                    @endif
            
                                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                        <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                                    </div>
                                </div>
            
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                <img src="{{ $details['photo'] }}" />
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p>{{ $details['name'] }}</p>
                                                <span class="price text-info"> ${{ $details['discount'] > 0 ? round((1 - $details['discount']/100) * $details['price'], 2) : $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                <br>
                                                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        <a href=" {{ route('mangashop.view.cart') }} " class="btn btn-secondary btn-block">View all</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->isAdmin())
                                    <a class="dropdown-item" href="/adminpanel">
                                        {{ __('Admin Dashboard') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pt-4 pb-5">
            @yield('content')
        </main>
        @include('inc.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script>
 
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
    @yield('scripts')
</body>
</html>
