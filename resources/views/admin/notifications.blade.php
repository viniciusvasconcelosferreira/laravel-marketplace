@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn-success">Marcar todas como
                lidas!</a>
            <hr>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Notificação</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($unreadNotifications as $n)
            <tr>
                <td>{{$n->data['message']}}</td>
                <td>{{$n->created_at->format('d/m/Y H:i:s')}} | {{$n->created_at->locale('pt')->diffForHumans()}}</td>
                <td style="text-transform: uppercase">
                    <div class="btn-group">
                        <a href="{{route('admin.notifications.read',['notification'=>$n->id])}}"
                           class="btn btn-sm btn-primary">Marcar como lida</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr class="table-warning" style="text-align: center">
                <td colspan="3">Não existem notificações a serem exibidas!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
