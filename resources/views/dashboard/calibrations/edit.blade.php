@extends('layouts.dashboard')
@section('title', 'Producto: '.$product->name)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Producto {{ $product->name }}</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('products.index') }}">Productos</a>
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
               {{ Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT']) }}
               <div class="ibox-content">
                  <div class="row">
                     <div class="col-sm-12 b-r">
                        <div class="form-group">
                           <label>Nombre: (*)</label> 
                           {{ Form::text('name', $product->name, ['class' => 'form-control']) }}
                           @if ($errors->has('name'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('name') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                            <label>Fabricante: (*)</label> 
                            {!! Form::select('id_fabricator', json_decode($fabricators->pluck('name', 'id'), true), $product->fabricator->id, ['class' => 'form-control', 'id' => 'name']) !!}
                            @if ($errors->has('fabricator'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('fabricator') }}</strong>
                              </span>
                            @endif
                         </div>
                        <div class="form-group">
                            <label>Modelo: (*)</label> 
                            {{ Form::text('model', $product->model, ['class' => 'form-control']) }}
                            @if ($errors->has('model'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('model') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Nro Serial: (*)</label> 
                            {{ Form::text('serial_number', $product->serial_number, ['class' => 'form-control']) }}
                            @if ($errors->has('serial_number'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('serial_number') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Cod Interno: (*)</label> 
                            {{ Form::text('internal_code', $product->internal_code, ['class' => 'form-control']) }}
                            @if ($errors->has('internal_code'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('internal_code') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Magnitud: (*)</label> 
                            {{ Form::text('magnitude', $product->magnitude, ['class' => 'form-control']) }}
                            @if ($errors->has('magnitude'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('magnitude') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Fecha ultima calibración: (*)</label> 
                            {{ Form::text('date_last_calibration', $product->date_last_calibration, ['class' => 'form-control']) }}
                            @if ($errors->has('date_last_calibration'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('date_last_calibration') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Fecha aprox. control de calibración: (*)</label> 
                            {{ Form::text('date_control_calibration', $product->date_control_calibration, ['class' => 'form-control']) }}
                            @if ($errors->has('date_control_calibration'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('date_control_calibration') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                           <label>Estado: (*)</label> 
                           {{ Form::text('status', $product->status, ['class' => 'form-control']) }}
                           @if ($errors->has('status'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('status') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                            <label>Otros: </label> 
                            {{ Form::text('others', $product->others, ['class' => 'form-control']) }}
                            @if ($errors->has('others'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('others') }}</strong>
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