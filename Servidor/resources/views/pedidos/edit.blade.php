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
            <form method="POST" action="{{ route('pedidos.update', ['pedido' => $pedido]) }}">
                @csrf
                @method("put")
                        @if (session("success"))
                            <div class="col-12 alert alert-success">
                                {{ session('success')}}
                            </div>
                        @endif
                <div class="form-floating mb-3 mt-3">
                    <input type="date" class="form-control" name="fecha" placeholder="dd/MM/YYYY" value="{{$pedido->fecha}}">
                    <label for="floatingInput">Fecha de Entrega: </label>
                </div>
                <div class="form-floating">
                    <select class="form-select" name="estado" aria-label="Floating label select example">
                        @if ($pedido->estado == 'solicitado')
                            <option value="solicitado" selected>Solicitado</option>
                            @else
                            <option value="solicitado">Solicitado</option>
                        @endif
                        @if ($pedido->estado == 'en_preparación')
                            <option value="en_preparacion" selected>En Preparación</option>
                            @else
                            <option value="en_preparacion">En Preparación</option>
                        @endif
                        @if ($pedido->estado == 'en_entrega')
                            <option value="en_entrega" selected>En Entrega</option>
                            @else
                            <option value="en_entrega">En Entrega</option>
                        @endif
                        @if ($pedido->estado == 'entregado')
                            <option value="entregado" selected>Entregado</option>
                            @else
                            <option value="entregado">Entregado</option>
                        @endif
                    </select>
                    <label for="floatingSelect">Estado:</label>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection