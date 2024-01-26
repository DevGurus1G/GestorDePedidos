@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("formatoproductos.create")}}" class="btn btn-outline-primary">Crear producto con formato</a>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Formato</th>
                <th>Imagenes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($formatoproductos))
                @foreach ($formatoproductos as $formatoproducto)
                <tr>
                    <td>
                        {{$formatoproducto->id}}
                    </td>
                    <td>
                        {{$formatoproducto->producto->nombre}}
                    </td>
                    <td>
                        {{$formatoproducto->formato->tipo}}
                    </td>
                    <td>
                        @foreach ($formatoproducto->imagenes as $imagen)
                            <img src="data:image/png;base64,{{ $imagen->imagen }}" height="32" width="32" alt="Hola" >
                        @endforeach
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{route("formatoproductos.show", $formatoproducto)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("formatoproductos.destroy", $formatoproducto)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="4">No hay productos con formato</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
