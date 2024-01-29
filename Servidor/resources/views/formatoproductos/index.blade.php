@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <a href="{{route("formatoproductos.create")}}" class="btn btn-outline-primary">Crear producto con formato</a>
</div>
<div class="col-12">
    <form action="{{ route('formatoproductos.index') }}" method="get" class="d-flex gap-2 my-2 ">
        <input type="text" name="producto" placeholder="Producto" class="form-control" value="{{ request('producto') }}">
        <input type="text" name="formato" placeholder="Formato" class="form-control" value="{{ request('formato') }}">
        <button type="submit" class="btn btn-info">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ffffff" d="M11 20q-.425 0-.712-.288T10 19v-6L4.2 5.6q-.375-.5-.112-1.05T5 4h14q.65 0 .913.55T19.8 5.6L14 13v6q0 .425-.288.713T13 20z"/></svg>
        </button>
        @if(request()->filled('nombre') || request()->filled('dni'))
            <a href="{{ route('formatoproductos.index') }}" class="btn btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ffffff" d="M14.8 11.975L6.825 4H19q.625 0 .9.55t-.1 1.05zM19.775 22.6L14 16.825V19q0 .425-.288.713T13 20h-2q-.425 0-.712-.288T10 19v-6.175l-8.6-8.6L2.8 2.8l18.4 18.4z"/></svg></a>
        @endif
    </form>
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
<div class="col-12">
    {{ $formatoproductos->appends(request()->except('page'))->links() }}
</div>
@endsection
