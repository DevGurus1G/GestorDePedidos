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
        @if(request()->filled('producto') || request()->filled('formato'))
            <a href="{{ route('formatoproductos.index') }}" class="btn btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#ffffff" d="M14.8 11.975L6.825 4H19q.625 0 .9.55t-.1 1.05zM19.775 22.6L14 16.825V19q0 .425-.288.713T13 20h-2q-.425 0-.712-.288T10 19v-6.175l-8.6-8.6L2.8 2.8l18.4 18.4z"/></svg></a>
        @endif
    </form>
</div>
<div class="col-12">
    <div class="table-responsive">
        <table class="table table-hover ">
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
                            <img src="data:image/png;base64,{{ $formatoproducto->imagenes->first()->imagen }}" height="32" width="32" alt="Hola" class="rounded-circle ">
                            + {{count($formatoproducto->imagenes) - 1}} imagen/es
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{route("formatoproductos.show", $formatoproducto)}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 56 56"><path fill="#ffffff" d="M28 51.906c13.055 0 23.906-10.828 23.906-23.906c0-13.055-10.875-23.906-23.93-23.906C14.899 4.094 4.095 14.945 4.095 28c0 13.078 10.828 23.906 23.906 23.906m-.211-32.25a3.026 3.026 0 0 1-3.047-3.047c0-1.71 1.336-3.07 3.047-3.07c1.71 0 3.047 1.36 3.047 3.07a3.026 3.026 0 0 1-3.047 3.047m-3.914 21.235c-.938 0-1.688-.68-1.688-1.641c0-.914.75-1.64 1.688-1.64h2.93V26.851h-2.532c-.937 0-1.687-.68-1.687-1.641c0-.914.75-1.64 1.687-1.64h4.43c1.172 0 1.828.843 1.828 2.109v11.93h2.906c.961 0 1.711.726 1.711 1.64c0 .96-.75 1.64-1.71 1.64Z"/></svg></a>
                            <form action="{{route("formatoproductos.destroy", $formatoproducto)}}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#ffffff" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1l-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button>
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
    
</div>
<div class="col-12">
    {{ $formatoproductos->appends(request()->except('page'))->links() }}
</div>
@endsection
