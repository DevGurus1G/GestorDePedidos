@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 form-floating mb-3 mt-3 mx-auto" style="max-width: 25%">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("users.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("users.edit", $user)}}" class="btn btn-warning">Editar</a>
                </div>
            </div>
            <h1>Editar usuario | {{$user->name}}</h1>
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
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre" value="{{$user->name}}">
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <select class="form-select" name="estado" aria-label="Floating label select example">
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
                    @if ($user->estado == 'administrativos')
                        <option value="administrativos" selected>Administrativo</option>
                        @else
                        <option value="administrativos">Administrativo</option>
                    @endif
                </select>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="email" name="email" placeholder="nombre" value="{{$user->email}}">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="password" class="form-control" id="password" name="password" placeholder="nombre">
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection