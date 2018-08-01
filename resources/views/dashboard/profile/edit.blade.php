@extends('layouts.dashboard')
@section('title', 'Usuarios')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Perfil</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li class="active">
            <a href="{{ route('profile.index', username()) }}">Perfil</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content">
   <div class="row animated fadeInRight">
      <div class="col-md-4"></div>
      <div class="col-md-4">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h1>Detalles de Perfil</h1>
            </div>
            <div>
               <div class="ibox-content profile-content">
                  <div class="perfil-update">
                     @include('dashboard.profile.partials.form')
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection