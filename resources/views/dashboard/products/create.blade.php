@extends('layouts.dashboard')
@section('title', "Creación de Equipo")
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2>Equipo</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}">Home</a>
         </li>
         <li>
            <a href="{{ route('products.index') }}">Equipos</a>
         </li>
         <li class="active">
            <a href="#">
                <strong>Crear</strong>
            </a>
          </li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Creación de Producto</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ Form::open(['route' => 'products.store']) }}
                      @include('dashboard.products.partials.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for new client -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva empresa</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['route' => 'clients.storeFromProduct']) }}
            @include('dashboard.clients.partials.form')
        {{ Form::close() }}
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Modal for new Fabricator -->
<div class="modal fade" id="ModalFabricator" tabindex="-1" role="dialog" aria-labelledby="ModalFabricatorLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalFabricatorLabel">Nuevo Fabricante</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['route' => 'fabricators.storeFromProduct']) }}
            @include('dashboard.fabricators.partials.form')
        {{ Form::close() }}
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
@endsection