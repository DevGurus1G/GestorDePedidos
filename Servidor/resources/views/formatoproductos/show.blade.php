@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
    <div class="col-12 mt-4 mx-auto max-w-50" style="max-width: 550px; width: 100%">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{route("formatoproductos.index")}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20z"/></svg></a>
                    <div class="d-flex gap-2">
                        <a href="{{route("formatoproductos.edit", $formatoproducto)}}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z"/><path fill="#ffffff" d="M5 2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h3v-2H5V4h12v4h2V4a2 2 0 0 0-2-2zm3 5a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zm7.949 3.811a3 3 0 0 1 4.242 4.243l-5.656 5.657a1 1 0 0 1-.707.293h-2.829a1 1 0 0 1-1-1v-2.829a1 1 0 0 1 .293-.707zm2.828 1.414a1 1 0 0 0-1.414 0l1.414 1.415a1 1 0 0 0 0-1.415m-1.414 2.829l-1.414-1.414l-3.95 3.95v1.414h1.414z"/></g></svg></a>
                        <form action="{{route("formatoproductos.destroy", $formatoproducto)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#ffffff" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1l-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button>
                        </form>
                    </div>
                </div>
                <h1>Ver detalles de producto | {{ $formatoproducto->producto->nombre}} - {{ $formatoproducto->formato->tipo }}</h1>
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
