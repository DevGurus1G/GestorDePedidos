@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("formatos.create")}}" class="btn btn-outline-primary">Crear formato</a>
</div>
<div class="col-12">
    <table class="table table-responsive table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($formatos))
                @foreach ($formatos as $formato)
                <tr>
                    <td>
                        {{$formato->id}}
                    </td>
                    <td>
                        {{$formato->tipo}}
                    </td>
                    <td class="d-flex gap-2">
                        <a href="{{route("formatos.show", $formato)}}" class="btn btn-primary">Ver detalles</a>
                        <form action="{{route("formatos.destroy", $formato)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            @else
                <tr>
                    <td colspan="3">No hay formatos</td>
                </tr>
            @endif 
        </tbody>
    </table>
</div>
@endsection
