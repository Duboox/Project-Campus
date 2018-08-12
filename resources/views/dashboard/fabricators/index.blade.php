@extends('layouts.dashboard')
@section('title', 'Fabricantes Registrados: '.$fabricator_count)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Fabricantes Registrados</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('fabricator.pdf') }}">Reporte en PDF</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Registrados: {{ $fabricator_count }}</h5>
               <div class="ibox-tools">
                    <a href="{{ route('fabricators.create') }}" class="btn btn-primary btn-xs">Crear Fabricante</a>
                </div>
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
                        <th>Descripción</th>
                        <th>Registro</th>
                        <th>Opciones</th>
                        <th colspan="1">&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($fabricators as $fabricator)
                    <tr>
                      <td>{{ $fabricator->id }}</td>
                      <td>{{ $fabricator->name }}</td>
                      <td>{{ $fabricator->description }}</td>
                      <td>{{ $fabricator->created_at->diffForHumans() }}</td>
                      @can('fabricators.edit')
                      <td width="10px">
                          <a href="{{ route('fabricators.edit', $fabricator->id) }}" class="btn btn-sm btn-info">
                              Editar
                          </a>
                      </td>
                      @endcan
                      @can('fabricators.destroy')
                      <td width="10px">
                          {{ Form::open(['route' => ['fabricators.destroy', $fabricator->id], 'method' => 'DELETE']) }}
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Desea eliminar este fabricante? Se eliminaran los productos asociados a el')">
                                  Eliminar
                              </button>
                          {{ Form::close() }}
                      </td>
                      @endcan
                    </tr>
                    @endforeach
                </tbody>
               </table>
                {{ $fabricators->render() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection