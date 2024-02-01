@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4 mx-auto max-w-50" >
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{route("formatoproductos.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("formatoproductos.edit", $formatoproducto)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("formatoproductos.destroy", $formatoproducto)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
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
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
            {{-- LAS IMAGENES --}}
            <div class="col-12 mb-3">
                <label class="form-label">Imágenes</label>
                <div class="row">
                    @foreach($formatoproducto->imagenes as $key => $imagen)
                        <div class="col-12">
                            <img src="data:image/png;base64,{{ $imagen->imagen }}" alt="Imagen" height="100" width="100" style="filter: contrast(50%)">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary change-image" data-bs-toggle="modal" data-bs-target="#imagen-{{$key}}">Cambiar</button>
                                {{-- Modal --}}
                                <div class="modal" tabindex="-1" id="imagen-{{$key}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Editar imagen {{$key + 1}}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route("productos_imagenes.update", $imagen->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method("PUT")
                                            <div class="modal-body">
                                                <input class="form-control" type="file" id="imagen" name="imagen">
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit">Cambiar</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                
                                <form action="{{route("productos_imagenes.destroy", $imagen->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection