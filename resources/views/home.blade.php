@extends('layouts.app')

@section('content')
@php
   $usr = \DB::table('sisme.user_storage')
             ->where('user_usr_id','=',Auth::user()->usr_id)
             ->first();
   $usr = collect($usr);

//SOLICITUDES
   $aprobado = \DB::table('sisme.article_requests')
         ->where('storage_origin_id','=',$usr['storage_id'])
         ->where('state', '=', 'Aprobado')
         ->count();
 
   $entregado = \DB::table('sisme.article_requests')
         ->where('storage_origin_id','=',$usr['storage_id'])
         ->where('state', '=', 'Entregado')
         ->count();

   $pendiente = \DB::table('sisme.article_requests')
         ->where('storage_origin_id','=',$usr['storage_id'])
         ->where('state', '=', 'Pendiente')
         ->count(); 

   $rechazado = \DB::table('sisme.article_requests')
         ->where('storage_origin_id','=',$usr['storage_id'])
         ->where('state', '=', 'Rechazado')
         ->count(); 
@endphp
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$aprobado}}</h3>
          <h5>Solicitudes Aprobados</45>
        </div>
        <div class="icon efectoicon">
          <i class="fas fa-thumbs-up"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$entregado}}<sup style="font-size: 20px"></sup></h3>
          <h5>Entregados</h5>
        </div>
        <div class="icon efectoicon">
          <i class="fas fa-truck"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$pendiente}}</h3>
          <h5>Pendientes</h5>
        </div>
        <div class="icon efectoicon">
          <i class="fas fa-user-clock"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $rechazado }}</h3>
          <h5>Rechazados</h5>
        </div>
        <div class="icon efectoicon">
          <i class="fas fa-thumbs-down"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div
@endsection
