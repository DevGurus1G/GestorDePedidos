@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("categorias.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("categorias.edit", $categoria)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("categorias.destroy", $categoria)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            <h1>Ver detalles de formato | {{$categoria->nombre}}</h1>
            <form action="{{route("categorias.update", $categoria)}}" method="post" class="row mt-2">
                @csrf
                @method("put")
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{$categoria->nombre}}">
                        <label for="nombre">Tipo</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection