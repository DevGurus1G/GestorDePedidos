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
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
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
                        {{$cliente->codigo_acceso}}
                    </td>
                    <td class="d-flex gap-2">
                        <form action="{{route("clientes.destroy", $cliente)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="4">No hay clientes</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
