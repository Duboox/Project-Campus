@extends('layouts.dashboard')
@section('title', 'Usuario: '.$data[0]->name)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Usuario {{ $data[0]->name }}</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li class="active">
            <a href="{{ route('users.index') }}">
                <strong>Usuarios</strong>
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
               {{ Form::model($data[0], ['route' => ['users.update', $data[0]->id], 'method' => 'PUT']) }}
               <div class="ibox-content">
                  <div class="row">
                     <div class="col-sm-12 b-r">
                        <div class="form-group">
                           <label>Nombre: (*)</label> 
                           {{ Form::text('name', $data[0]->name, ['class' => 'form-control']) }}
                           @if ($errors->has('name'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('name') }}</strong>
                             </span>
                           @endif
                        </div>
                         <div class="form-group">
                           <label>Correo Eléctronico: (*)</label> 
                           {{ Form::text('email', $data[0]->email, ['class' => 'form-control']) }}
                           @if ($errors->has('email'))
                             <span class="error-validate">
                                <strong>{{ $errors->first('email') }}</strong>
                             </span>
                           @endif
                        </div>
                        <div class="form-group">
                          {{ Form::label('name', 'Rol') }}
                          <select name="role" class="form-control">
                            @if(count($data[0]->roles) > 0)
                              <optgroup label="Rol Seleccionado">
                                <option value="{{ $data[0]->roles[0]->id }}" selected>{{ $data[0]->roles[0]->name }}</option>
                              </optgroup>
                            @endif
                            <option value="">Seleccione</option>
                            <optgroup label="Roles Disponibles">
                              @foreach($data[1] as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                              @endforeach
                            </optgroup>
                          </select>
                          @if ($errors->has('role'))
                            <span class="error-validate">
                                <strong>{{ $errors->first('role') }}</strong>
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