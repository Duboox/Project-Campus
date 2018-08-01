@extends('layouts.dashboard')
@section('title', 'Roles')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Lista de Roles</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Home</a>
         </li>
         <li class="active">
            <a href="{{ route('roles.create') }}">Crear Rol</a>
         </li>
         <li>
            <strong>
              <a href="{{ route('assigns.index') }}">Roles Asignados</a>
            </strong>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Roles Disponible</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
               </div>
            </div>
            <div class="ibox-content table-responsive">
              @include('alert.alerts')
               <table class="table responsive">
                  <thead>
                     <tr>
                        <th>#ID</th>
                        <th>Rol</th>
                        <th>Slug</th>
                        <th>Descripción</th>
                        <th>Registro</th>
                        <th>Opciones</th>
                        <th colspan="3">&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $role)
                    @if($role->slug !== 'developer')
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->slug }}</td>
                            <td>
                              @if(!$role->description == '')
                                {{ $role->description }}
                              @else
                                Sin descripción
                              @endif
                            </td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            @can('roles.edit')
                            <td width="10px">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-info">
                                    Editar
                                </a>
                            </td>
                            @endcan
                            @can('roles.destroy')
                            <td width="10px">
                                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}
                                    <button onclick="return confirm('Está seguro de este rol?')"; class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                {!! Form::close() !!}
                            </td>
                            @endcan
                        </tr>
                        @endif
                    @endforeach
                  </tbody>
               </table>
               {{ $roles->render() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection