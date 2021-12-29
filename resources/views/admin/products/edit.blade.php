@extends('layouts.app')
@section('content')
    <h1>Atualizar Produto</h1>
    <form action="{{route('admin.products.update',['product'=>$product->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror"></textarea>
            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror">
            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <a class="btn btn-lg btn-secondary" href="{{route('admin.products.index')}}" role="button">Voltar à
                Página</a>
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Produto</button>
        </div>
    </form>

@endsection
