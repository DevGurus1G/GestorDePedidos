@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("clientes.create")}}" class="btn btn-outline-primary  ">Crear Cliente</a>
</div>
<div class="col-12">
    <form action="{{ route('clientes.index') }}" method="get" class="d-flex gap-2 mt-2 ">
        <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{ request('nombre') }}">
        <input type="text" name="dni" placeholder="DNI" class="form-control" value="{{ request('dni') }}">
        <button type="submit" class="btn btn-info">Filtrar</button>
        @if(request()->filled('nombre') || request()->filled('dni'))
            <a href="{{ route('clientes.index') }}" class="btn btn-warning">Limpiar Filtros</a>
        @endif
    </form>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>codigo_acceso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($clientes))
                @foreach ($clientes as $cliente)
                <tr>
                    <td>
                        {{$cliente->id}}
                    </td>
                    <td>
                        {{$cliente->nombre}}
                    </td>
                    <td>
                        {{$cliente->dni}}
                    </td>
                    <td>
                        {{$cliente->codigo_acceso}}
                    </td>
                    <td class="d-flex gap-2">
                        <form action="{{route("clientes.destroy", $cliente)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                        <a href="{{route("clientes.show", $cliente)}}" class="btn btn-primary ">Ver detalles</a>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="5">No hay clientes</td>
                </tr>
            @endif 
        </tbody>
    </table>

    
</div>
<div class="col-12">
    {{ $clientes->appends(request()->except('page'))->links() }}
</div>
@endsection