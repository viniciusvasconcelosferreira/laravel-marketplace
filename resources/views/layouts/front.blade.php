<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;margin-left: 20px">

    <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent"
         style="flex-direction: row;place-content: space-between;">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            @foreach($categories as $category)
                <li class="nav-item @if(request()->is('category/'.$category->slug)) active @endif">
                    <a class="nav-link"
                       href="{{route('category.single',['slug'=>$category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach

            @auth
                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                </li>
            @endauth
            {{--            <li class="nav-item @if(request()->is('/cart*')) active @endif">--}}
            {{--                <a href="{{route('cart.index')}}" class="nav-link" dir="ltr">--}}
            {{--                    Carrinho--}}
            {{--                    <span class="badge bg-danger">--}}
            {{--                            @if(session()->has('cart'))--}}
            {{--                            --}}{{--                                    Quantidade de produtos--}}
            {{--                            {{count(session()->get('cart'))}}--}}
            {{--                            --}}{{--                                Quantidade de cada produto--}}
            {{--                            --}}{{--                                    {{array_sum((array_column(session()->get('cart'),'amount')))}}--}}
            {{--                        @else--}}
            {{--                            0--}}
            {{--                        @endif </span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>


        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item @if(request()->is('/my-orders*')) active @endif"><a
                            href="{{route('user.orders')}}"
                            class="nav-link">Meus Pedidos</a></li>
                @endauth
                <li class="nav-item @if(request()->is('/cart*')) active @endif">
                    <a href="{{route('cart.index')}}" class="nav-link">
                        <span style="font-size: 26px" class="fa-layers fa-fw">
                            <i class="fa-solid fa-cart-shopping"></i>
                                <span class="fa-layers-counter" style="background:red">
                                    @if(session()->has('cart'))
                                        {{count(session()->get('cart'))}}
                                    @else
                                        0
                                    @endif
                                </span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>


    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"
        integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
