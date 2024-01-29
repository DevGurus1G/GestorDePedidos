@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("users.create")}}" class="btn btn-outline-primary">Crear usuarios</a>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users))
                @foreach ($users as $user)
                <tr>
                    <td>
                        {{$user->id}}
                    </td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->rol}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{route("users.show", $user)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("users.destroy", $user)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="5">No hay usuario</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection