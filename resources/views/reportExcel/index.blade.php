@extends('layouts.app')

@section('content')
  <head>
    <center><h3>REPORTES GENERALES</h3></center><br>
  </head>

  <div id="inventario" style="display: none;">
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="id_dia" name="id_dia" placeholder="Introduzca dia" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="busca_mes" onclick="fechadiainv();">Generar por dia</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_inicio" name="id_dia_inicio" placeholder="Introduzca dia">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_fin" name="id_dia_fin" placeholder="Introduzca dia">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="busca_mes" onclick="BuscarfechaRango();">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="resumido" style="display: none;">
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="resdia" name="resdia" placeholder="Introduzca dia" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="busca_res" onclick="fechadiares();">Generar por diaaaa</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_inicio" name="id_dia_inicio" placeholder="Introduzca dia">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_fin" name="id_dia_fin" placeholder="Introduzca dia">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="busca_mes" onclick="BuscarfechaRango();">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="ingreso" style="display: none;">
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="id_dia" name="id_dia" placeholder="Introduzca dia" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="busca_mes" onclick="fechadia();">Generar por diaaaa ing</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_inicio" name="id_dia_inicio" placeholder="Introduzca dia">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_fin" name="id_dia_fin" placeholder="Introduzca dia">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="busca_mes" onclick="BuscarfechaRango();">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="salida" style="display: none;">
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="id_dia" name="id_dia" placeholder="Introduzca dia" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="busca_mes" onclick="fechadia();">Generar por diaaaa sal</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_inicio" name="id_dia_inicio" placeholder="Introduzca dia">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_dia_fin" name="id_dia_fin" placeholder="Introduzca dia">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="busca_mes" onclick="BuscarfechaRango();">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="mensual" style="display: none;">
  <div class="row">
    <div class="col-md-4">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="id_dia" name="id_dia" placeholder="Introduzca dia" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="busca_mes" onclick="fechadia();">Generar mes</button>
                </span>
            </div>                            
        </div>
     </div>
    </div>
  </div>
  <br>
<div class="row">
    <div class="col-sm-3 col-6">
      <a href="#" class=""  onclick="mostrar();"> 
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
      {{-- <a href="{{ url('rptMensual') }}" class=""> --}}
      <a href="#" class="" onclick="mostrar4();">
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
      {{-- <a href="{{ url('rptResumido') }}" class="" onclick="mostrarinventario();"> --}}
      <a href="#" class="" onclick="mostrar1();">
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
      {{-- <a href="{{ url('reporte_Ingreso_General') }}" class=""> --}}
      <a href="#" class="" onclick="mostrar2();">
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
      {{-- <a href="{{ url('reporte_Salida_General') }}" class=""> --}}
      <a href="#" class="" onclick="mostrar3();">
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

{{-- @push('scripts') --}}
<script>
  {{-- @section('script') --}}

  // $(document).ready(function () {
     function fechadiainv(){
        // $('#id_dia').click(function () {
          var dia = document.getElementById('id_dia').value;
            $.ajax({
                type: "GET",
                url: "/rptInventario/"+dia+"",
                // data: { idProveedor: 1 },
                // data: {"id_dia": $("#id_dia").val()},
                // dataType: "json",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/rptInventario/'+dia+'';
                },
                error: function () {
                    alert("Error");
                }
            });
        // });
      }

      function fechadiares(){
          var resdia = document.getElementById('resdia').value;
          console.log('ress',resdia);
            $.ajax({
                type: "GET",
                url: "/rptResumido/"+resdia+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/rptResumido/'+resdia+'';
                },
                error: function () {
                    alert("Error");
                }
            });
      }

     function mostrar(){
        $('#inventario').show();
        $('#resumido').hide();
        $('#ingreso').hide();
        $('#salida').hide();
        $('#mensual').hide();
     }

     function mostrar1(){    
        $('#inventario').hide();
        $('#resumido').show(); 
        $('#ingreso').hide();
        $('#salida').hide();
        $('#mensual').hide();
      }

     function mostrar2(){    
        $('#inventario').hide();
        $('#resumido').hide(); 
        $('#salida').hide();
        $('#mensual').hide();
        $('#ingreso').show();
      }

     function mostrar3(){    
        $('#inventario').hide();
        $('#resumido').hide(); 
        $('#ingreso').hide();
        $('#mensual').hide();
        $('#salida').show();
      }

     function mostrar4(){    
        $('#inventario').hide();
        $('#resumido').hide(); 
        $('#ingreso').hide();
        $('#salida').hide();
        $('#mensual').show();
      }

    // });
  // $('.datepickerDays').datepicker({
  //       format: "dd/mm/yyyy",        
  //       language: "es",
  //   }).datepicker("setDate", new Date());  
  {{-- @endsection --}}
</script>
{{-- @endpush --}}