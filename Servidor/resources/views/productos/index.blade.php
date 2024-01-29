@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("productos.create")}}" class="btn btn-outline-primary">Crear producto</a>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($productos))
                @foreach ($productos as $producto)
                <tr>
                    <td>
                        {{$producto->id}}
                    </td>
                    <td>
                        {{$producto->nombre}}
                    </td>
                    <td>
                        {{$producto->categoria->nombre}}
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{route("productos.show", $producto)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("productos.destroy", $producto)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="4">No hay productos</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
