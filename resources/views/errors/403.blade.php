@extends('layouts.errors')
@section('title', 'Acción no Autorizada')
@section('content')
<div class="middle-box text-center animated pulse">
    <h1>403</h1>
    <h3 class="font-bold">Acción no Autorizada</h3>
    <div class="error-desc">
        <a href="javascript:history.back(1)" class="btn btn-primary m-t">Atrás</a>
    </div>
</div>
@endsection