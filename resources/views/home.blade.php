@extends('layouts.dashboard')
@section('title', config('app.name'))
@section('content')
<div class="row border-bottom white-bg dashboard-header">
   <div class="col-sm-5 no-padding">
      <h2>{{ config('app.name') }} +Admin</h2>
   </div>
   
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Menú de usuario</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
               </div>
            </div>
            <div class="ibox-content table-responsive">
                <a href="{{ route('services.index') }}" class="btn btn-sm btn-info"> Solicitudes </a>
                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-info"> Empresas </a>
                <a href="{{ route('fabricators.index') }}" class="btn btn-sm btn-info"> Fabricantes </a>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-info"> Equipos </a>
                <a href="{{ route('calibrations.index') }}" class="btn btn-sm btn-info"> Control de calibraciones </a>
            </div>
         </div>
      </div>
   </div>
    @role('admin')
    <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Menú de Administrador</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
               </div>
            </div>
            <div class="ibox-content table-responsive">
            {{ Form::open(['route' => ['products.searchIncoming'], 'method' => 'GET', 'class' => 'form-inline']) }}
               <div class="ibox-content">
                  <div class="row">
                    <div class="form-group">
                            {{ Form::label('since', 'Desde') }}
                            {{ Form::date('since', null, ['class' => 'form-control', 'id' => 'since']) }}
                            @if ($errors->has('since'))
                                <span class="error-validate">
                                    <strong>{{ $errors->first('since') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group">
                            {{ Form::label('until', 'Hasta') }}
                            {{ Form::date('until', null, ['class' => 'form-control', 'id' => 'until']) }}
                            @if ($errors->has('until'))
                                <span class="error-validate">
                                    <strong>{{ $errors->first('until') }}</strong>
                                </span>
                            @endif
                    </div>
                           {{ Form::submit('Buscar Equipos entrantes', ['class' => 'btn btn-sm btn-primary']) }}
                  </div>
               </div>
               {{ Form::close() }}
               {{ Form::open(['route' => ['products.searchDischarged'], 'method' => 'GET', 'class' => 'form-inline']) }}
               <div class="ibox-content">
                  <div class="row">
                    <div class="form-group">
                            {{ Form::label('since', 'Desde') }}
                            {{ Form::date('since', null, ['class' => 'form-control', 'id' => 'since']) }}
                            @if ($errors->has('since'))
                                <span class="error-validate">
                                    <strong>{{ $errors->first('since') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group">
                            {{ Form::label('until', 'Hasta') }}
                            {{ Form::date('until', null, ['class' => 'form-control', 'id' => 'until']) }}
                            @if ($errors->has('until'))
                                <span class="error-validate">
                                    <strong>{{ $errors->first('until') }}</strong>
                                </span>
                            @endif
                    </div>
                           {{ Form::submit('Buscar Equipos de alta', ['class' => 'btn btn-sm btn-primary']) }}
                  </div>
               </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
    @endrole
   
</div>
@endsection