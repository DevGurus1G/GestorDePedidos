@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4 mx-auto max-w-50" >
    <div class="row">
        <div class="col">
            <a href="{{route("formatoproductos.index")}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20z"/></svg></a>
            <h1>Crear producto</h1>
            <form action="{{route("formatoproductos.store")}}" method="post" class="row mt-2" enctype="multipart/form-data">
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

                <div class="col-12 mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <select name="producto_id" id="producto_id" class="form-select">
                        <option value="-1" selected hidden>Seleccione una opcion</option>
                        @foreach($productos as $producto)
                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="formato_id" class="form-label">Formato</label>
                    <select name="formato_id" id="formato_id" class="form-select">
                        <option value="-1" selected hidden>Seleccione una opcion</option>
                        @foreach($formatos as $formato)
                        <option value="{{$formato->id}}">{{$formato->tipo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="00.00">
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="disponibilidad" id="disponibilidad" value="1">
                        <label class="form-check-label" for="disponibilidad">
                            Disponible
                        </label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="imagenes" class="form-label">Imagenes</label>
                    <input class="form-control" type="file" id="imagenes" name="imagenes[]" multiple>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection