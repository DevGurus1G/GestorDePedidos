@extends('layouts.app')
@section('nav')
    @include('layouts.nav')
@endsection



@section('content')
<div class="col-12 mt-4">
    <div class="row">
        <div class="col">
            <a href="{{route("formatos.index")}}" class="btn btn-secondary">Volver</a>
            <h1>Crear formato</h1>
            <form action="{{route("formatos.store")}}" method="post" class="row mt-2">
                @csrf
                @if (session("success"))
                    <div class="col-12 alert alert-success">
                        {{ session('success')}}
                    </div>
                @endif

                <div class="col-12 form-floating mb-3">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="tipo" name="tipo" placeholder="tipo">
                        <label for="tipo">Tipo</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection