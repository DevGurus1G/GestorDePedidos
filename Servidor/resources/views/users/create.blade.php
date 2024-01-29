@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <a href="{{route("users.index")}}" class="btn btn-secondary">Volver</a>
            <h1>Crear usuario</h1>
            <form action="{{route("users.store")}}" method="post" class="row mt-2">
                @csrf
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
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre">
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select name="rol" id="rol" class="form-control">
                        <option value="-1" selected hidden>Seleccione una opcion</option>
                        @foreach($roles as $rol)
                        <option value="{{$rol}}">{{$rol}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="email" name="email" placeholder="nombre">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="nombre">
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection