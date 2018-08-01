@extends('layouts.dashboard')
@section('title', 'Productos Registrados: '.count($products))
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Productos Registrados</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Inicio</a>
         </li>
         <li>
            <a href="{{ route('product.pdf') }}">Reporte en PDF</a>
         </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <div class="ibox float-e-margins">
            <div class="ibox-title">
               <h5>Registrados: {{ count($products) }}</h5>
               <div class="ibox-tools">
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-xs">Crear Producto</a>
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
                        <th>Fabricante</th>
                        <th>Modelo</th>
                        <th>Nro Serial</th>
                        <th>Cod Interno</th>
                        <th>Fecha ultima calibración</th>
                        <th>Fecha aprox. control de calibración</th>
                        <th>Estado</th>
                        <th>Otros</th>
                        <th>Registro</th>
                        <th>Opciones</th>
                        <th colspan="1">&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->name }}</td>
                      @if($product->fabricator!=null)
                        <td>{{ $product->fabricator->name }}</td>
                      @endif
                      <td>{{ $product->model }}</td>
                      <td>{{ $product->serial_number }}</td>
                      <td>{{ $product->internal_code }}</td>
                      <td>{{ $product->date_last_calibration }}</td>
                      <td>{{ $product->date_control_calibration }}</td>
                      <td>{{ $product->status }}</td>
                      <td>{{ $product->others }}</td>
                      <td>{{ $product->created_at->diffForHumans() }}</td>
                      @can('products.edit')
                      <td width="10px">
                          <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">
                              Editar
                          </a>
                      </td>
                      @endcan
                      @can('products.destroy')
                      <td width="10px">
                          {{ Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE']) }}
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Desea eliminar este producto?')">
                                  Eliminar
                              </button>
                          {{ Form::close() }}
                      </td>
                      @endcan
                    </tr>
                     @endforeach
                </tbody>
               </table>
                {{ $products->render() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection