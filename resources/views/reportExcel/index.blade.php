@extends('layouts.app')

@section('content')
<div class="row">

 
    <div class="col-sm-3 col-1">
      <a href="{{ url('rptInventario') }}" class=""> 
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>INVENTARIO</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div>
  
    <!-- ./col -->
     <div class="col-sm-3 col-6">
      <a href="{{ url('rptMensual') }}" class="">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>MENSUAL</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel" ></i>
        </div>
      </div>
      </a>
    </div>
    <!-- ./col -->
   <div class="col-sm-3 col-6">
      <a href="{{ url('rptResumido') }}" class="">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>RESUMIDO</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div>
    <!-- ./col -->
   {{--     <div class="col-sm-3 col-6">
      <a href="{{ url('rptMensual') }}" class="">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>REPORTE</h3>
          <h3>INGRESO SALIDA</h3>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div> --}}
    <!-- ./col -->
  </div
@endsection