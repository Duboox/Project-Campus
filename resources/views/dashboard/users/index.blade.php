@extends('layouts.dashboard')
@section('title', 'Usuarios Registrados: '.count($users))
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Usuarios Registrados</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('user.pdf') }}">Reporte en PDF</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Registrados: {{ count($users) }}</h5>
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
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Avatar</th>
                        <th>Registro</th>
                        <th>Opciones</th>
                        <th colspan="1">&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->last_name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <img src="{{ url_img('avatars', $user->avatar) }}" class="avatars_icon">
                      </td>
                      <td>{{ $user->created_at->diffForHumans() }}</td>
                      @can('users.edit')
                      <td width="10px">
                          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info">
                              Editar
                          </a>
                      </td>
                      @endcan
                      @can('users.destroy')
                      <td width="10px">
                          {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) }}
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Desea eliminar este usuario?')">
                                  Eliminar
                              </button>
                          {{ Form::close() }}
                      </td>
                      @endcan
                    </tr>
                    @endforeach
                </tbody>
               </table>
                {{ $users->render() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection