@extends('layouts.dashboard')
@section('title', 'Empresa: '.$client->name)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Cliente {{ $client->name }}</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('clients.index') }}">Empresas</a>
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
               {{ Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT']) }}
               <div class="ibox-content">
                  <div class="row">
                     <div class="col-sm-12 b-r">
                        <div class="form-group">
                           <label>Empresa: (*)</label> 
                           {{ Form::text('name', $client->name, ['class' => 'form-control']) }}
                           @if ($errors->has('name'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('name') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                           <label>Rubro: (*)</label> 
                           {{ Form::text('rubro', $client->rubro, ['class' => 'form-control']) }}
                           @if ($errors->has('rubro'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('rubro') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                            <label>Responsable: (*)</label> 
                            {{ Form::text('last_name', $client->last_name, ['class' => 'form-control']) }}
                            @if ($errors->has('last_name'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('last_name') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Ciudad: (*)</label> 
                            {{ Form::text('city', $client->city, ['class' => 'form-control']) }}
                            @if ($errors->has('city'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('city') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Residencia: (*)</label> 
                            {{ Form::text('residency', $client->residency, ['class' => 'form-control']) }}
                            @if ($errors->has('residency'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('residency') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Zona: (*)</label> 
                            {{ Form::text('zone', $client->zone, ['class' => 'form-control']) }}
                            @if ($errors->has('zone'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('zone') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Telefono: (*)</label> 
                            {{ Form::text('phone', $client->phone, ['class' => 'form-control']) }}
                            @if ($errors->has('phone'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('phone') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                            <label>Celular: (*)</label> 
                            {{ Form::text('fax', $client->fax, ['class' => 'form-control']) }}
                            @if ($errors->has('fax'))
                              <span class="error-validate">
                                 <strong>{{ $errors->first('fax') }}</strong>
                              </span>
                            @endif
                         </div>
                         <div class="form-group">
                           <label>Correo Eléctronico: (*)</label> 
                           {{ Form::text('email', $client->email, ['class' => 'form-control']) }}
                           @if ($errors->has('email'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('email') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                           <label>Pagina Web: (*)</label> 
                           {{ Form::text('web_page', $client->web_page, ['class' => 'form-control']) }}
                           @if ($errors->has('web_page'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('web_page') }}</strong>
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