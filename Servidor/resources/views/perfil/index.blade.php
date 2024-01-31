
@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection


@section('content')
<div class="col-12 form-floating mb-3 mt-3 mx-auto" style="max-width: 50%">
    <div class="row">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{route("home")}}" class="btn btn-secondary">Volver</a>
            <div class="d-flex gap-2">
                <a href="{{route("perfil.edit", $user)}}" class="btn btn-warning">Editar</a>
            </div>
        </div>
        <h1> Usuario | {{$user->name}}</h1>
        <div class="col">
            <form action="{{route("users.store")}}" method="post" class="row mt-2">
                @csrf
                <h3> Datos Personales </h3>
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @elseif($errors->any())
                    <div class="col-12 alert alert-danger ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre" value="{{$user->name}}" disabled>
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre" value="{{$user->rol}}" disabled>
                        <label for="name">Rol</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{$user->email}}" disabled>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="contraseña" disabled>
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary" disabled>Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection