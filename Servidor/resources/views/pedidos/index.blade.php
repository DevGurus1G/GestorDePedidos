@extends('layouts.app')
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
                <th>Producto/s</th>
                <th>Cantidad</th>
                <th>Cliente</th>
                <th>Fecha de Entrega</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($pedidos))
                @foreach ($pedidos as $pedido)
                <tr>
                    <td>
                        {{$pedido->id}}
                    </td>
                    <td>
                        @foreach ($pedido->pedidoformatoproducto as $pedidoformatoproducto)
                            <p>{{$pedidoformatoproducto->formatoproducto->producto->nombre}} - {{$pedidoformatoproducto->formatoproducto->formato->tipo}}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($pedido->pedidoformatoproducto as $pedidoformatoproducto)
                            <p>{{$pedidoformatoproducto->cantidad}}</p>
                        @endforeach
                    </td>
                    <td>
                        {{$pedido->cliente->nombre}}
                    </td>
                    <td>
                        {{$pedido->fecha}}
                    </td>
                    <td>
                        @switch($pedido->estado)
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
                    <td class="d-flex flex-column justify-content-center gap-2">
                        <a href="{{route("pedidos.show", $pedido)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("pedidos.destroy", ['pedido' => $pedido->id])}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger w-100">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="7">No hay pedidos</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
