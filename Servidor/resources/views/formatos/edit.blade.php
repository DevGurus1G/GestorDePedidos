@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between ">
                <a href="{{route("formatos.index")}}" class="btn btn-secondary">Volver</a>
                <div class="d-flex gap-2">
                    <a href="{{route("formatos.edit", $formato)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route("formatos.destroy", $formato)}}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
            <h1>Ver detalles de formato | {{$formato->tipo}}</h1>
            <form action="{{route("formatos.update", $formato)}}" method="post" class="row mt-2">
                @csrf
                @method("put")
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="tipo" name="tipo" placeholder="tipo" value="{{$formato->tipo}}">
                        <label for="tipo">Tipo</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection