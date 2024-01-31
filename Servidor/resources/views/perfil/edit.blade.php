@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12">
    <div class="row">
        <div class="col form-floating mb-3 mt-3 mx-auto" style="max-width: 50%">
            <div class="d-flex justify-content-between ">
                <a href="{{route("perfil.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("perfil.edit", $user)}}" class="btn btn-warning">Editar</a>
                </div>
            </div>
            <div class="col mt-3">
            <h1>Editar usuario | {{$user->name}}</h1>
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
            <form action="{{route("perfil.update", $user)}}" method="post" class="row mt-3 mb-3">
                @csrf
                @method("put")
                <h3> Datos Personales </h3>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre" value="{{$user->name}}">
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="rol" aria-label="Floating label select example">
                        @if ($user->rol == 'comercial')
                            <option value="comercial" selected>Comercial</option>
                            @else
                            <option value="comercial">Comercial</option>
                        @endif
                        @if ($user->rol == 'responsable')
                            <option value="responsable" selected>Responsable</option>
                            @else
                            <option value="responsable">Responsable</option>
                        @endif
                        @if ($user->rol == 'administrativo')
                            <option value="administrativo" selected>Administrativo</option>
                            @else
                            <option value="administrativo">Administrativo</option>
                        @endif
                    </select>
                    <label for="floatingSelect" style="left:unset">Roles:</label>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="email" name="email" placeholder="nombre" value="{{$user->email}}">
                        <label for="email">Email</label>
                    </div>
                </div>
                <input type="hidden" name="perfil" value="perfil">
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            <hr>
            <form action="{{route("perfil.update", $user)}}" method="post" class="row mt-3 mb-3">
                @csrf
                @method('put')
                <h3> Actualizar Contraseña </h3>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="password" class="form-control" id="passwordA" name="passwordA" placeholder="password">
                        <label for="password">Contraseña Actual:</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="password" class="form-control" id="passwordN" name="passwordN" placeholder="password">
                        <label for="password">Contraseña Nueva:</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="password" class="form-control" id="confirmNP" name="confirmNP" placeholder="password">
                        <label for="password">Confirmar contraseña:</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            <form action="{{route("users.destroy", $user)}}" method="post">
                @csrf
                @method("delete")
                <input type="hidden" name="perfil" value="perfil">
                <button type="submit" class="btn btn-danger">Borrar Cuenta</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection