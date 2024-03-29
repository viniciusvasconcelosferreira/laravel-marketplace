@extends('layouts.front')

@section('content')
    <div class="front row">
        <div class="col-4">
            @if($store->logo)
                <img src="{{asset('storage/'.$store->logo)}}" alt="{{$store->name}}" class="img-fluid"
                     style="border-radius: 10px">
            @else
                <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem logo" class="img-fluid"
                     style="border-radius: 10px">
            @endif
        </div>

        <div class="col-8">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p><strong>Contatos: </strong><span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span></p>
        </div>

        <div class="col-12">
            <hr>
            <h3 style="margin-bottom: 30px">Produtos desta loja</h3>
        </div>

        @forelse($store->products as $key => $product)
            <div class="col-md-4">
                <div class="card h-100" style="width: 100%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/'.$product->photos->first()->image)}}" class="card-img-top"
                             alt="">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" class="card-img-top" alt="">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                    </div>
                    <div class="card-footer bg-transparent" style="border-top: 0">
                        <h3>
                            R$ {{number_format($product->price,'2',',','.')}}
                        </h3>
                        <a href="{{route('product.single',['slug'=>$product->slug])}}" class="btn btn-success">Ver
                            produto</a>
                    </div>
                </div>
            </div>
            @if(($key + 1)%3==0)</div>
    <div class="front row">@endif
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Nenhum produto encontrado para esta loja!</h3>
            </div>
        @endforelse
    </div>
@endsection
