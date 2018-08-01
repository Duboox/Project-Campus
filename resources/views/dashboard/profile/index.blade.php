@extends('layouts.dashboard')
@section('title', username())
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Perfil</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li class="active">
            <a href="{{ route('profile.edit', id_user()) }}">Editar</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="col-md-4"></div>
   <div class="col-md-4">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
         	@include('alert.alerts')
            <h1>Detalles de Perfil</h1>
         </div>
         <div>
            <div class="ibox-content profile-content">
               <h4>
               	Nombre & Apellido: 
                  <strong>{{ fullname(username(), auth()->user()->last_name)  }}</strong>
               </h4>
               <hr>
               <h5>
                  Correo Eléctronico: {{ auth()->user()->email }}
               </h5>
               <hr>
               <div class="row m-t-lg">
               </div>
               <div class="user-button">
                  <div class="row">
                     <div class="col-md-12">
                        <a href="{{ route('profile.edit', id_user()) }}" class="btn btn-info btn-sm btn-block">
                        	<i class="fa fa-coffee"></i> Modificar
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection