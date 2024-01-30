@extends('layouts.app')

@section('nav')
@include('layouts.nav')
@endsection

@section('content')

<div class="col-12">
    <div class="row" >
        <div class="col-12 form-floating mb-3 mt-3 mx-auto" style="max-width: 50%;">
            <h3>Crear Pedido</h3>
            <form method="POST" action="{{ route('pedidos.store')}}">
                @csrf
                <div class="form-floating">
                    <select class="form-select" name="formato_producto_id" aria-label="Floating label select example">
                        <option selected>Seleccione un Producto</option>
                        @foreach ($formatoproductos as $formatoproducto)
                        <option value="{{ $formatoproducto->id }}">{{ $formatoproducto->producto->nombre}} - {{$formatoproducto->formato->tipo}}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Productos</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" value="1">
                    <label for="floatingInput">Cantidad</label>
                </div>
                {{-- @if (isset($pedido))
                    <div class="form-floating mb-3 mt-3">
                        <input type="date" class="form-control" name="fecha" placeholder="fecha" value="{{$pedido->fecha}}" readonly>
                        <label for="fecha">Fecha de entrega</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="cliente_id" readonly>
                            <option>Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                            @if ($cliente == $pedido->cliente)
                            <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre }}</option>
                            @else 
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endif
                            @endforeach
                        </select>
                        <label for="clienteSelect">Clientes</label>
                    </div>
                @else
                    <div class="form-floating mb-3 mt-3">
                        <input type="date" class="form-control" name="fecha" placeholder="fecha">
                        <label for="fecha">Fecha de entrega</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="cliente_id">
                            <option selected>Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="clienteSelect">Clientes</label>
                    </div>
                @endif --}}
                <div class="form-floating mb-3 mt-3">
                    <input type="date" class="form-control" name="fecha" placeholder="fecha">
                    <label for="fecha">Fecha de entrega</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="cliente_id">
                        <option selected>Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    <label for="clienteSelect">Clientes</label>
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Crear
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">¿Tiene mas productos el pedido?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mas_productos" id="no" value="true">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mas_productos" id="no" value="false" checked>
                                    <label class="form-check-label" for="no">
                                      No
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection