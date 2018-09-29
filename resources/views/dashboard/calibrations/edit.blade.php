@extends('layouts.dashboard')
@section('title', 'Equipo: '.$product->name)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Equipo {{ $product->name }}</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('products.index') }}">Equipos</a>
         </li>
         <li class="active">
            <a href="#">
                <strong>Editar</strong>
            </a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Requeridos (*)</h5>
            </div>
            <div class="ibox-content">
               {{ Form::model($product, ['route' => ['calibrations.update', $product->id], 'method' => 'PUT']) }}
               <div class="ibox-content">
                  <div class="row">
                     <div class="col-sm-12 b-r">
                         <div class="form-group">
                           <label>Estado: (*)</label> 
                           {{ Form::select('status', array(0 => 'Equipo vencido', 1 => 'Equipo vigente'), $product->status, ['class' => 'form-control']) }}
                           @if ($errors->has('status'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('status') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                           <label>Despachado: (*)</label> 
                           {{ Form::select('delivery_status', array(0 => 'En proceso de calibración', 1 => 'Calibrado'), $product->delivery_status, ['class' => 'form-control']) }}
                           @if ($errors->has('delivery_status'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('delivery_status') }}</strong>
                             </span>
                           @endif
                        </div>

                        <div class="submit-button">
                           {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary pull-left m-t-n-xs']) }}
                        </div>
                     </div>
                  </div>
               </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection