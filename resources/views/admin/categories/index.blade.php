@extends('layouts.app')
@section('content')
    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success">Criar Categoria</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td style="text-transform: uppercase">
                    <div class="btn-group">
                        <a href="{{route('admin.categories.edit',['category'=>$category->id])}}"
                           class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{route('admin.categories.destroy',['category'=>$category->id])}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$categories->links('pagination::bootstrap-4')}}

@endsection
