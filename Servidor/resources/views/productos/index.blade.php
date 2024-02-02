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
                        <a href="{{route("productos.show", $producto)}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 56 56"><path fill="#ffffff" d="M28 51.906c13.055 0 23.906-10.828 23.906-23.906c0-13.055-10.875-23.906-23.93-23.906C14.899 4.094 4.095 14.945 4.095 28c0 13.078 10.828 23.906 23.906 23.906m-.211-32.25a3.026 3.026 0 0 1-3.047-3.047c0-1.71 1.336-3.07 3.047-3.07c1.71 0 3.047 1.36 3.047 3.07a3.026 3.026 0 0 1-3.047 3.047m-3.914 21.235c-.938 0-1.688-.68-1.688-1.641c0-.914.75-1.64 1.688-1.64h2.93V26.851h-2.532c-.937 0-1.687-.68-1.687-1.641c0-.914.75-1.64 1.687-1.64h4.43c1.172 0 1.828.843 1.828 2.109v11.93h2.906c.961 0 1.711.726 1.711 1.64c0 .96-.75 1.64-1.71 1.64Z"/></svg></a>
                        <form action="{{route("productos.destroy", $producto)}}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#ffffff" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1l-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button>
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
