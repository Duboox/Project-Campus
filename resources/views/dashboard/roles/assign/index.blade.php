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
         <li>
            <a href="{{ route('roles.index') }}">Roles</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Roles Asignados Disponible</h5>
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
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($rolAssign as $data)
                      <tr>
                          <td>{{ $data->id }}</td>
                          <td>{{ $data->name }}</td>
                      </tr>
                    @endforeach
                  </tbody>
               </table>
               <hr>
               <h1>Roles Asociados</h1>
               <table class="table responsive">
                  <thead>
                     <tr>
                        <th>Rol</th>
                        <th>Usuario(s)</th>
                     </tr>
                  </thead>
                  <tbody>
                      @foreach($rolAssign as $data)
                        @if(count($data->users) > 0)
                          <tr>
                            <td class="active">{{ $data->name }}</td>
                              @foreach($data->users as $user)
                                <td>{{ $user->name }}</td>
                              @endforeach
                            </tr>
                          @else
                          <tr>
                            <td>Rol sin usuario</td>
                          </tr>
                          @endif
                      @endforeach
                  </tbody>
               </table>
               {{ $rolAssign->render() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection