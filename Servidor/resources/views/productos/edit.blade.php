@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("productos.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("productos.edit", $producto)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("productos.destroy", $producto)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            <h1>Ver detalles del Producto | {{$producto->nombre}}</h1>
            <form action="{{route("productos.update", $producto)}}" method="post" class="row mt-2">
                @csrf
                @method("put")
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control"  id="nombre" name="nombre" placeholder="nombre" value="{{$producto->nombre}}">
                        <label for="tipo">Nombre</label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="categoria_id" class="form-label">Categoria</label>
                    <select name="categoria_id" id="categoria_id" class="form-select" >
                        @foreach($categorias as $categoria)
                        @if ($categoria == $producto->categoria)
                            <option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
                        @else
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection