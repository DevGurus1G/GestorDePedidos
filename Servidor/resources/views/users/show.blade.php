@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("users.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("users.edit", $user)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("users.destroy", $user)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            <h1>Detalles de usuario | {{$user->name}}</h1>
            <form action="{{route("users.update", $user)}}" method="post" class="row mt-2">
                @csrf
                @method("put")
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @elseif($errors->any())
                    <div class="col-12 alert alert-danger ">
                        <ul class="list-unstyled m-0 ">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre" value="{{$user->name}}" disabled >
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select name="rol" id="rol" class="form-control" disabled >
                        @foreach($roles as $rol)
                            @if ($rol == $user->rol)
                                <option value="{{$rol}}" selected>{{$rol}}</option>
                            @else
                                <option value="{{$rol}}">{{$rol}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="email" name="email" placeholder="nombre" value="{{$user->email}}" disabled >
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="password" class="form-control" id="password" name="password" placeholder="nombre" disabled >
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary" disabled >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection