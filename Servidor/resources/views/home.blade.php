@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@endsection

@section('content')
Esta por verse

{{Auth::user()->rol}}
@endsection