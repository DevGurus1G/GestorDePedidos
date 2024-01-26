@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection
@section("content")
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("clientes.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("clientes.edit", $cliente)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("clientes.destroy", $cliente)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            <h1>Detalles cliente | {{$cliente->nombre}}</h1>
            <form action="{{route("clientes.update", $cliente)}}" method="post" class="row mt-2">
                @csrf
                @method("put")
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" readonly value="{{$cliente->nombre}}">
                        <label for="nombre">Nombre</label>
                    </div>
                </div>
                <div class="col-12 input-group">
                    <input type="text" class="form-control" readonly name="codigo_acceso" id="codigo_acceso" placeholder="Codigo de acceso" value="{{$cliente->codigo_acceso}}" >
                    <button class="btn btn-outline-primary" disabled  id="generar_codigo" onclick="generarCodigo()" type="button">Generar</button>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary" disabled >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection