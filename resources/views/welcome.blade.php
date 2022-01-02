@extends('layouts.front')

@section('content')
    <div class="front row">
        @foreach($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    @if($product->photos->count())
                        <img src="{{asset('storage/'.$product->photos->first()->image)}}" class="card-img-top" alt="">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" class="card-img-top" alt="">
                    @endif
                    <div class="car-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
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
        @endforeach
    </div>
@endsection
