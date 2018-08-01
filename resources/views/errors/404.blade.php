@extends('layouts.errors')
@section('title', 'Página no encontrada')
@section('content')
<div class="middle-box text-center animated pulse">
    <h1>404</h1>
    <h3 class="font-bold">Página no encontrada...</h3>
    <div class="error-desc">
        <a href="javascript:history.back(1)" class="btn btn-primary m-t">Atrás</a>
    </div>
</div>
@endsection