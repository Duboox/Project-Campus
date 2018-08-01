@extends('layouts.errors')
@section('title', 'Error Interno del Servidor')
@section('content')
<div class="middle-box text-center animated pulse">
    <h1>500</h1>
    <h3 class="font-bold">
        {{ $exception }}
        Error Interno del Servidor
    </h3>
    <div class="error-desc">
        <a href="javascript:history.back(1)" class="btn btn-primary m-t">Atrás</a>
    </div>
</div>
@endsection
