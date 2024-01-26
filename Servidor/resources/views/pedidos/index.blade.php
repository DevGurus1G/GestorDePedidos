@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("pedidos.create")}}" class="btn btn-outline-primary">Crear Pedido</a>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Fecha de Entrega</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($pedidoFormatoProductos))
                @foreach ($pedidoFormatoProductos as $pedidoFormatoProducto)
                <tr>
                    <td>
                        {{$pedidoFormatoProducto->pedido->id}}
                    </td>
                    <td>
                        {{-- {{$pedidoFormatoProducto->FormatoProducto->Producto->id}} --}}
                    </td>
                    <td>
                        {{$pedidoFormatoProducto->pedido->cliente->nombre}}
                    </td>
                    <td>
                        {{$pedidoFormatoProducto->pedido->fecha}}
                    </td>
                    <td>
                        @switch($pedidoFormatoProducto->pedido->estado)
                            @case('solicitado')
                                Solicitado
                                @break
                            @case('en_preparacion')
                                En Preparación
                                @break
                            @case('en_entrega')
                                En Entrega
                                @break
                            @case('entregado')
                                Entregado
                                @break    
                        @endswitch
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{route("pedidos.show", $pedidoFormatoProducto->pedido)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("pedidos.destroy", ['pedido' => $pedidoFormatoProducto->pedido->id])}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="3">No hay pedidos</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
