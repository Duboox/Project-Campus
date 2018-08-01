@extends('layouts.dashboard')
@section('content')
@section('title', config('app.name'))
<div class="row border-bottom white-bg dashboard-header">
   <div class="col-sm-5 no-padding">
      <h2>{{ config('app.name') }} +Admin</h2>
   </div>
   <div class="col-sm-12">
      <div class="row text-left">
         <img src="{{ url_img('static', 'bienvenido.png') }}" class="img-home">
      </div>
   </div>
</div>
@endsection
