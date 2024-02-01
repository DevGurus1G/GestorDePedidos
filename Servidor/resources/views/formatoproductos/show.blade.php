@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
    <div class="col-12 mt-4 mx-auto max-w-50" style="max-width: 550px; width: 100%">
        <div class="row">
            <div class="col">
                <a href="{{ route('formatoproductos.index') }}" class="btn btn-secondary">Volver</a>
                <h1>Ver detalles de producto | </h1>
                <form action="{{ route('formatoproductos.store') }}" method="post" class="row mt-2"
                    enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="col-12 alert alert-success">
                            {{ session('success') }}
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
                        <select name="producto_id" id="producto_id" class="form-select" disabled>
                            <option value="-1" selected hidden>Seleccione una opcion</option>
                            @foreach ($productos as $producto)
                                @if ($producto->id == $formatoproducto->producto->id)
                                    <option value="{{ $producto->id }}" selected>{{ $producto->nombre }}</option>
                                @else
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="formato_id" class="form-label">Formato</label>
                        <select name="formato_id" id="formato_id" class="form-select" disabled>
                            <option value="-1" selected hidden>Seleccione una opcion</option>
                            @foreach ($formatos as $formato)
                                @if ($formato->id == $formatoproducto->formato->id)
                                    <option value="{{ $formato->id }}" selected>{{ $formato->tipo }}</option>
                                @else
                                    <option value="{{ $formato->id }}">{{ $formato->tipo }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-floating mb-3">
                        <div class="form-floating ">
                            <input type="number" class="form-control" id="precio" name="precio" placeholder="00.00"
                                value="{{ $formatoproducto->precio }}" disabled>
                            <label for="precio">Precio</label>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-check">
                            @if ($formatoproducto->disponibilidad == 1)
                                <input class="form-check-input" type="checkbox" name="disponibilidad" id="disponibilidad"
                                    value="1" checked disabled>
                            @else
                                <input class="form-check-input" type="checkbox" name="disponibilidad" id="disponibilidad"
                                    value="1" disabled>
                            @endif
                            <label class="form-check-label" for="disponibilidad">
                                Disponible
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" disabled>Crear</button>
                    </div>
                </form>
                {{-- LAS IMAGENES --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Imágenes</label>
                    <div class="row">
                        <div class="col">
                            <div id="carouselExampleIndicators" class="carousel slide">
                                <div class="carousel-indicators">
                                    @foreach ($formatoproducto->imagenes as $key => $imagen)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $key }}" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($formatoproducto->imagenes as $key => $imagen)
                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }} ratio ratio-1x1">
                                            <img src="data:image/png;base64,{{ $imagen->imagen }}"
                                                class="d-block w-100 object-fit-cover  " alt="Imagen">
                                        </div>
                                    @endforeach
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
