@extends('layouts.app')

@section('aside')
@include('layouts.aside')
@endsection

@section('nav')
@include('layouts.nav')
@endsection

@section('content')

<div class="col-12">
    <div class="row" >
        <div class="col-12 form-floating mb-3 mt-3 mx-auto" style="max-width: 50%;">
            <h3>Crear Pedido</h3>
            <form method="POST" action="{{ route('pedidos.store')}}">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Seleccione un Producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre}}</option>
                      @endforeach
                    </select>
                    <label for="floatingSelect">Productos</label>
                  </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="dd/MM/YYYY">
                    <label for="floatingInput">Fecha (DD/MM/YYYY): </label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="clienteSelect" name="cliente_id">
                        <option selected>Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    <label for="clienteSelect">Clientes</label>
                </div>
                <button type="button" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>

@endsection