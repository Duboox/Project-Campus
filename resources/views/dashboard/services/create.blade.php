@extends('layouts.dashboard')
@section('title', "Creación de Solicitud")
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Solicitud</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Home</a>
         </li>
         <li>
            <a href="{{ route('services.index') }}">Solicitudes</a>
         </li>
         <li class="active">
            <a href="#">
                <strong>Crear</strong>
            </a>
          </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Creación de Solicitud</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open(['route' => ['services.store', 'productID' => $product->id], 'method' => 'POST']) }}
                      @include('dashboard.services.partials.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection