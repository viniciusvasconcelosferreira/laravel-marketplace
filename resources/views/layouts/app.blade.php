<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marktplace L6</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px">

    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Marktplace L6</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/orders*')) active @endif" aria-current="page"
                           href="{{route('admin.orders.my')}}">Meus Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/stores*')) active @endif" aria-current="page"
                           href="{{route('admin.stores.index')}}">Loja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/products*')) active @endif" aria-current="page"
                           href="{{route('admin.products.index')}}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/categories*')) active @endif" aria-current="page"
                           href="{{route('admin.categories.index')}}">Categorias</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <span class="nav-link">{{auth()->user()->name}}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" aria-current="page"
                               onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>
                            <form action="{{route('logout')}}" class="logout" method="post" style="display: none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
    </div>
</nav>
<div class="container">
    @include('flash::message')
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"
        integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
