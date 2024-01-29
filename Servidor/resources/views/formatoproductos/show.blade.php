@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4 mx-auto max-w-50" >
    <div class="row">
        <div class="col">
            <a href="{{route("formatoproductos.index")}}" class="btn btn-secondary">Volver</a>
            <h1>Ver detalles de producto | </h1>
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
                            @if ($producto->id == $formatoproducto->producto->id)
                            <option value="{{$producto->id}}" selected>{{$producto->nombre}}</option>
                            @else
                            <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="formato_id" class="form-label">Formato</label>
                    <select name="formato_id" id="formato_id" class="form-select">
                        <option value="-1" selected hidden>Seleccione una opcion</option>
                        @foreach($formatos as $formato)
                            @if ($formato->id == $formatoproducto->formato->id)
                            <option value="{{$formato->id}}" selected>{{$formato->tipo}}</option>
                            @else
                            <option value="{{$formato->id}}">{{$formato->tipo}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="00.00" value="{{$formatoproducto->precio}}">
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-check">
                        @if ($formatoproducto->disponibilidad == 1)
                        <input class="form-check-input" type="checkbox" name="disponibilidad" id="disponibilidad" value="1" checked>    
                        @else
                        <input class="form-check-input" type="checkbox" name="disponibilidad" id="disponibilidad" value="1">    
                        @endif
                        <label class="form-check-label" for="disponibilidad">
                            Disponible
                        </label>
                    </div>
                </div>
                {{-- <div class="col-12 mb-3">
                    <label for="imagenes" class="form-label">Imagenes</label>
                    <input class="form-control" type="file" id="imagenes" name="imagenes[]" multiple>
                </div> --}}
                <div class="col-12 mb-3">
                    <label for="imagenes" class="form-label">Imágenes</label>
                    <div class="image-container">
                        @foreach($formatoproducto->imagenes as $imagen)
                            <div class="position-relative">
                                <img src="data:image/png;base64,{{ $imagen->imagen }}" alt="Imagen" class="img-thumbnail" style="filter: contrast(50%)">
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <button class="btn btn-primary change-image" data-imagen="{{ $imagen->id }}">Cambiar</button>
                                    <form action="{{route("productos_imagenes.destroy")}}" method="post"></form>
                                    <button class="btn btn-danger delete-image" data-imagen="{{ $imagen->id }}">Eliminar</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
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