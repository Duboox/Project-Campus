@extends('layouts.dashboard')
@section('title', 'Solicitudes de Servicio Registrados: '.$service_count)
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Solicitudes de Servicio Registrados</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <!-- <li>
            <a href="{{ route('services.pdf') }}">Reporte en PDF</a>
         </li> -->
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Busqueda:</h5>
               <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
               </div>
            </div>
            {{ Form::open(['route' => ['services.search'], 'method' => 'GET', 'class' => 'form-inline']) }}
               <div class="ibox-content">
                  <div class="row">
                        <div class="form-group">
                        {{ Form::select('field', array('id' => 'ID', 'client' => 'Empresa', 'product' => 'Equipo'), ['class' => 'form-control', 'id' => 'field']) }}
                        {!! Form::text('input', null, ['class' => 'form-control', 'id' => 'input']) !!}
                        </div>
                           {{ Form::submit('Buscar', ['class' => 'btn btn-sm btn-primary']) }}
                  </div>
               </div>
               {{ Form::close() }}
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Registrados: {{ $service_count }}</h5>
               <!-- <div class="ibox-tools">
                    <a href="{{ route('services.create') }}" class="btn btn-primary btn-xs">Crear Solicitud</a>
                </div> -->
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
                        <th>Fecha ingreso</th>
                        <th>Fecha devolución</th>
                        <th>Empresa</th>
                        <th>Equipo</th>
                        <th>Observación</th>
                        <th>Registro</th>
                        <th>Opciones</th>
                        <th colspan="1">&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($services as $service)
                    <tr>
                      <td>{{ $service->id }}</td>
                      <td>{{ $service->date_entry }}</td>
                      <td>{{ $service->date_return }}</td>
                      @if($service->client!=null)
                        <td>{{ $service->client->name }}</td>
                      @endif
                      @if($service->product!=null)
                        <td>{{ $service->product->name }}</td>
                      @endif
                      <td>{{ $service->observation }}</td>
                      <td>{{ $service->created_at->diffForHumans() }}</td>
                      @can('services.show')
                      <td width="10px">
                          <a href="{{ route('services.show', $service->id) }}" class="btn btn-sm btn-info">
                              Ver
                          </a>
                      </td>
                      @endcan
                      @can('services.edit')
                      <td width="10px">
                          <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-info">
                              Editar
                          </a>
                      </td>
                      @endcan
                      @can('services.destroy')
                      <td width="10px">
                          {{ Form::open(['route' => ['services.destroy', $service->id], 'method' => 'DELETE']) }}
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Desea eliminar esta solicitud de servicio?')">
                                  Eliminar
                              </button>
                          {{ Form::close() }}
                      </td>
                      @endcan
                      <!-- if($service->product->status==1 && $service->product->delivery_status==1) -->
                      @if($service->product->status==1)
                        @can('services.certificate')
                          <td width="10px">
                              <a href="{{ route('services.certificate', $service->id) }}" class="btn btn-sm btn-info">
                                  Certificado
                              </a>
                          </td>
                        @endcan
                      @endif
                    </tr>
                    @endforeach
                </tbody>
               </table>
                {{ $services->render() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection