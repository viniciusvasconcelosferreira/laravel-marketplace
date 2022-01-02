@extends('layouts.app')
@section('content')
    <h1>Atualizar Categoria</h1>
    <form action="{{route('admin.categories.update',['category'=>$category->id])}}" method="post">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label>Nome Categoria</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{$category->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                   value="{{$category->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <a class="btn btn-lg btn-secondary" href="{{route('admin.categories.index')}}" role="button">Voltar à
                Página</a>
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Categoria</button>
        </div>

    </form>

@endsection
