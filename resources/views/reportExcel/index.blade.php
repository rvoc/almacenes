@extends('layouts.app')

@section('content')
<div class="row">

 
    <div class="col-sm-3 col-6">
      <a href="{{ url('rptInventario') }}" class=""> 
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4></strong>
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
    <div class="col-sm-3 col-6">
      <a href="{{ url('reporte_Ingreso_General') }}" class="">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>GENERAL DE INGRESO</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div>
    <div class="col-sm-3 col-6">
      <a href="{{ url('reporte_Salida_General') }}" class="">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>GENERAL DE SALIDA</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div>

  
  {{-- </div --}}
@endsection