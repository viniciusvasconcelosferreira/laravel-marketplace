@extends('layouts.app')
@section('content')
    <a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @if(is_null($products) or $products->count() <= 0)
            <tr class="text-center">
                <td colspan="5">O usuário não possui loja e/ou produto(s) cadastrado(s)!</td>
            </tr>
        @else
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>R$ {{number_format($product->price,2,',','.')}}</td>
                    <td>{{$product->store->name}}</td>
                    <td style="text-transform: uppercase">
                        <div class="btn-group">
                            <a href="{{route('admin.products.edit',['product'=>$product->id])}}"
                               class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{route('admin.products.destroy',['product'=>$product->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if($products)
        {{$products->links('pagination::bootstrap-4')}}
    @endif
@endsection
