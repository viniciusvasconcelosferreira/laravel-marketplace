@extends('layouts.app')
@section('content')
    <h1>Criar loja</h1>
    <form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nome Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                   value="{{old('description')}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{old('phone')}}">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror"
                   value="{{old('mobile_phone')}}">
            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Fotos do Produto</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        {{--<div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                   value="{{old('slug')}}">
            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>--}}

        {{--        <div class="form-group">--}}
        {{--            <label>Usuário</label>--}}
        {{--            <select name="user" class="form-control">--}}
        {{--                @foreach($users as $user)--}}
        {{--                    <option value="{{$user->id}}">{{$user->name}}</option>--}}
        {{--                @endforeach--}}
        {{--            </select>--}}
        {{--        </div>--}}

        <div>
            <a class="btn btn-lg btn-secondary" href="{{route('admin.stores.index')}}" role="button">Voltar à Página</a>
            <button type="submit" class="btn btn-lg btn-primary">Criar Loja</button>
        </div>
    </form>

@endsection
