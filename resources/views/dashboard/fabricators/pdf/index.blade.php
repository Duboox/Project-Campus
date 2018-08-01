@extends('layouts.dashboard')
@section('content')
@section('title', 'Reporte de usuarios')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Usuarios Registrados</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('users.index') }}">Usuarios</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Registros</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
                  </a>
               </div>
            </div>
            <div class="ibox-content">
               <div>
                  <h3>
                     <i class="fa fa-file-pdf-o"></i> Reporte General
                  </h3>
                  <a href="{{ route('all.user.pdf') }}" class="btn btn-primary">General</a>
               </div>
               <hr>
               <h3>
                  <i class="fa fa-calendar"></i> Reporte por Fecha
               </h3>
               {{ Form::open(['route' => 'user.pdf.report', 'class' => '', 'method' => 'POST']) }}
               <div class="ibox-content">
                  <div class="row">
                     <div class="col-sm-12 b-r">
                        <div class="form-group">
                           <label>Desde: (*)</label> 
                           {{ Form::date('from', null, ['class' => 'form-control']) }}
                           @if ($errors->has('from'))
                            <span class="error-validate">
                              <strong>{{ $errors->first('from') }}</strong>
                            </span>
                           @endif
                        </div>
                        <div class="form-group">
                           <label>Hasta: (*)</label> 
                           {{ Form::date('to', null, ['class' => 'form-control']) }}
                           @if ($errors->has('to'))
                           <span class="error-validate">
                              <strong>{{ $errors->first('to') }}</strong>
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