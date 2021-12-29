@extends('layouts.app')
@section('content')
    <h1>Atualizar loja</h1>
    <form action="{{route('admin.stores.update',['store'=>$store->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{$store->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                   value="{{$store->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{$store->phone}}">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror"
                   value="{{$store->mobile_phone}}">
            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                   value="{{$store->slug}}">
            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <a class="btn btn-lg btn-secondary" href="{{route('admin.stores.index')}}" role="button">Voltar à Página</a>
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Loja</button>
        </div>
    </form>

@endsection
