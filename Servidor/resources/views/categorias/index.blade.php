@extends('layouts.app')
@section('aside')
    @include('layouts.aside')
@endsection
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("categorias.create")}}" class="btn btn-outline-primary">Crear categoria</a>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($categorias))
                @foreach ($categorias as $categoria)
                <tr>
                    <td>
                        {{$categoria->id}}
                    </td>
                    <td>
                        {{$categoria->nombre}}
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{route("categorias.show", $categoria)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("categorias.destroy", $categoria)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="3">No hay categorias</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
