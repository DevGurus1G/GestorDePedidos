@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <a href="{{route("productos.index")}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20z"/></svg></a>
            <h1>Crear producto</h1>
            <form action="{{route("productos.store")}}" method="post" class="row mt-2">
                @csrf
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre">
                        <label for="tipo">Nombre</label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="categoria_id" class="form-label">Categoria</label>
                    <select name="categoria_id" id="categoria_id" class="form-select">
                        <option value="-1" selected hidden>Seleccione una opcion</option>
                        @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection