@extends('layouts.dashboard')
@section('title', 'Solicitud: '.$service->date_delivery)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Solicitud {{ $service->date_delivery }}</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('services.index') }}">Solicitudes</a>
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
               {{ Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'PUT']) }}
               <div class="ibox-content">
                  <div class="row">
                     <div class="col-sm-12 b-r">
                        <!-- <div class="form-group">
                           <label>Fecha recepción: (*)</label> 
                           {{ Form::date('date_entry', $service->date_entry, ['class' => 'form-control']) }}
                           @if ($errors->has('date_entry'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('date_entry') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                            <label>Fecha conclusión: (*)</label> 
                            {{ Form::date('date_return', $service->date_return, ['class' => 'form-control']) }}
                            @if ($errors->has('date_return'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('date_return') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                          <label>Cliente: (*)</label> 
                          {!! Form::select('id_client', json_decode($clients->pluck('name', 'id'), true), $service->client->id, ['class' => 'form-control select2-search', 'id' => 'name']) !!}
                          @if ($errors->has('id_client'))
                            <span class="error-validate">
                               <strong>{{ $errors->first('id_client') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label>Equipo: (*)</label> 
                          {!! Form::select('id_product', json_decode($products->pluck('name', 'id'), true), $service->product->id, ['class' => 'form-control select2-search', 'id' => 'name']) !!}
                          @if ($errors->has('id_product'))
                            <span class="error-validate">
                               <strong>{{ $errors->first('id_product') }}</strong>
                            </span>
                          @endif
                        </div> -->
                        <div class="form-group">
                          <label>Observación: (*)</label> 
                          {!! Form::text('observation', $service->observation, ['class' => 'form-control', 'id' => 'name']) !!}
                          @if ($errors->has('observation'))
                            <span class="error-validate">
                               <strong>{{ $errors->first('observation') }}</strong>
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