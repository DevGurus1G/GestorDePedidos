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
                    <select class="form-select" name="producto_id" aria-label="Floating label select example">
                        <option selected>Seleccione un Producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre}}</option>
                      @endforeach
                    </select>
                    <label for="floatingSelect">Productos</label>
                </div>
                <div class="form-floating mt-3">
                    <select class="form-select" name="formato_id" aria-label="Floating label select example">
                        <option selected>Seleccione un Formato</option>
                        @foreach ($formatos as $formato)
                        <option value="{{ $formato->id }}">{{ $formato->tipo }}</option>
                      @endforeach
                    </select>
                    <label for="floatingSelect">Productos</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="date" class="form-control" name="fecha" placeholder="dd/MM/YYYY">
                    <label for="floatingInput">Fecha de Entrega: </label>
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
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection