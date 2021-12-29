@extends('layouts.app')
@section('content')
    <h1>Atualizar loja</h1>
    <form action="{{route('admin.stores.update',['store'=>$store->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Loja</label>
            <input type="text" name="name" class="form-control" value="{{$store->name}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$store->description}}">
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" class="form-control" value="{{$store->phone}}">
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control" value="{{$store->mobile_phone}}">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$store->slug}}">
        </div>

        <div>
            <a class="btn btn-lg btn-secondary" href="{{route('admin.stores.index')}}" role="button">Voltar à Página</a>
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Loja</button>
        </div>
    </form>

@endsection
