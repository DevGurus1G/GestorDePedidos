@extends('layouts.app')


@section('nav')
@include('layouts.nav')
@endsection

@section('content')

<div class="col-12">
    <div class="row" >
        <div class="col-12 form-floating mb-3 mt-3 mx-auto" style="max-width: 50%;">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{route("pedidos.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("pedidos.edit", $pedido)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("pedidos.destroy", $pedido)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            <h3>Detalles Pedido</h3>
            <form method="POST" action="{{ route('pedidos.store')}}">
                @csrf
                <div class="form-floating mb-3 mt-3">
                    <input type="date" class="form-control" name="fecha" placeholder="dd/MM/YYYY" value="{{$pedido->fecha}}" disabled>
                    <label for="floatingInput">Fecha de Entrega: </label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    @switch($pedido->estado)
                            @case('solicitado')
                                <input type="text" class="form-control" name="estado" placeholder="estado" value="Solicitado" disabled>
                                <label for="floatingInput">Estado:</label>
                                @break
                            @case('en_preparacion')
                                <input type="text" class="form-control" name="estado" placeholder="estado" value="En Preparación" disabled>
                                <label for="floatingInput">Estado:</label>
                                @break
                            @case('en_entrega')
                                <input type="text" class="form-control" name="estado" placeholder="estado" value="En Entrega" disabled>
                                <label for="floatingInput">Estado:</label>
                                @break
                            @case('entregado')
                                <input type="text" class="form-control" name="estado" placeholder="estado" value="Entregado" disabled>
                                <label for="floatingInput">Estado:</label>
                                @break    
                        @endswitch
                    
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary" disabled >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection