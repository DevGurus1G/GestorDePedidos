@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row w-100 mx-auto" style="max-width: 550px">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("perfil.index")}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20z"/></svg></a>
                <div class="d-flex gap-2">
                    <a href="{{route("perfil.edit", $user)}}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z"/><path fill="#ffffff" d="M5 2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h3v-2H5V4h12v4h2V4a2 2 0 0 0-2-2zm3 5a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zm7.949 3.811a3 3 0 0 1 4.242 4.243l-5.656 5.657a1 1 0 0 1-.707.293h-2.829a1 1 0 0 1-1-1v-2.829a1 1 0 0 1 .293-.707zm2.828 1.414a1 1 0 0 0-1.414 0l1.414 1.415a1 1 0 0 0 0-1.415m-1.414 2.829l-1.414-1.414l-3.95 3.95v1.414h1.414z"/></g></svg></a>
                </div>
            </div>
            <div class="col mt-3">
            <h1 class="mt-2">Editar usuario | {{$user->name}}</h1>
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