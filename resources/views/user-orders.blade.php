@extends('layouts.front')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Pedidos Realizados</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @forelse($userOrders as $key => $order)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{$key}}" aria-expanded="true"
                                    aria-controls="collapse{{$key}}">
                                Pedido nº: {{$order->reference}}
                            </button>
                        </h2>
                        <div id="collapse{{$key}}" class="accordion-collapse collapse @if($key==0) show @endif"
                             aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    @php $items = unserialize($order->items);  @endphp
                                    @foreach($items as $item)
                                        <li>{{$item['name']}}
                                            | {{number_format($item['price'] * $item['amount'],2,',','.')}}
                                            <br>
                                            Quantidade pedida: {{$item['amount']}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Nenhum pedido recebido!</div>
                @endforelse
            </div>
            <hr>
            {{$userOrders->links()}}
        </div>
    </div>

@endsection
