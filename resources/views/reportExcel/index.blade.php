@extends('layouts.app')

@section('content')
  <head>
    <center><h3>REPORTE</h3></center>
  </head>

  <div id="inventario" style="display: none;">
  <center><h3>INVENTARIO</h3></center><br>
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="id_dia" name="id_dia" placeholder="yyy/mm/dd"> 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="fechadiainv">Generar por dia</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="dia_inv_ini" name="dia_inv_ini" placeholder="yyy/mm/dd">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="dia_inv_fin" name="dia_inv_fin" placeholder="yyy/mm/dd">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="rangofechinv">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="resumido" style="display: none;">
  <center><h3>RESUMIDO</h3></center><br>
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="resdia" name="resdia" placeholder="yyy/mm/dd" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="fechadiares">Generar por dia</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_res_ini" name="id_res_ini" placeholder="yyy/mm/dd">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="id_res_fin" name="id_res_fin" placeholder="yyy/mm/dd">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="rangofechres">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="ingreso" style="display: none;">
  <center><h3>GENERAL DE INGRESOS</h3></center><br>
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="ing" name="ing" placeholder="Introduzca dia" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="fechadingr">Generar por dia</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="dia_ing_ini" name="dia_ing_ini" placeholder="yyy/mm/dd">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="dia_ing_fin" name="dia_ing_fin" placeholder="yyy/mm/dd">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="rangofeching">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="salida" style="display: none;">
  <center><h3>GENERAL DE SALIDAS</h3></center><br>
  <div class="row">
    <div class="col-md-2">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="idsal" name="idsal" placeholder="yyy/mm/dd" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="fechasal">Generar por dia</button>
                </span>
            </div>                            
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group">
          <div class="input-group">
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="dia_sal_ini" name="dia_sal_ini" placeholder="yyy/mm/dd">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control datepickerDays" id="dia_sal_fin" name="dia_sal_fin" placeholder="yyy/mm/dd">  
            </div>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="rangofechsal">generar rango fechas</button>
            </span>
          </div>                            
        </div>
     </div> 
    </div>
  </div>

  <div id="mensual" style="display: none;">
  <center><h3>MENSUAL</h3></center><br>
  <div class="row">
    <div class="col-md-4">   
    </div>
     <div class="col-md-3">
        <div class="input-group">
            <div class="input-group">
              <input type="text" class="form-control datepickerDays" id="mesrpt" name="mesrpt" placeholder="mm/yyyy" > 
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="mes">Generar mes</button>
                </span>
            </div>                            
        </div>
     </div>
    </div>
  </div>
  <br>
<div class="row">
   <div class="col-sm-1 col-6">
    </div>

    <div class="col-sm-2 col-6">
      <a href="#" class="boton" id="mostrar">  
      <!-- small box -->
      <div class="small-box bg-info">
        {{-- style="background: rgb(249, 249, 249);"rgb(247, 211, 88) --}}
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
     <div class="col-sm-2 col-6">
      {{-- <a href="{{ url('rptMensual') }}" class=""> --}}
      <a href="#" class="" id="mostrar4">
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
   <div class="col-sm-2 col-6">
      {{-- <a href="{{ url('rptResumido') }}" class="" onclick="mostrarinventario();"> --}}
      <a href="#" class="" id="mostrar1">
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
    <div class="col-sm-2 col-6">
      {{-- <a href="{{ url('reporte_Ingreso_General') }}" class=""> --}}
      <a href="#" class="" id="mostrar2">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>INGRESO</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div>
    <div class="col-sm-2 col-6">
      {{-- <a href="{{ url('reporte_Salida_General') }}" class=""> --}}
      <a href="#" class="" id="mostrar3">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h4>REPORTE</h4>
          <h4>SALIDA</h4>
        </div>
        <div class="icon efectoicon">
            <i class="fa fa-file-excel"></i>
        </div>
      </div>
      </a>
    </div>
    {{-- <input id="datepicker" /> --}}
    {{-- <script>
        $('#datepicker').datepicker();
    </script>  --}}
    {{-- <a href="#" id="mb" class="boton" onclick = "changeColor(this);">enlace</a> --}}

  
  {{-- </div --}}
@endsection

{{-- @push('scripts') --}}
<script>
  @section('script')

  // $('#datepicker').datepicker();
  $( "#fechadiainv" ).click(function() {
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
        
      })

      $( "#fechadiares" ).click(function() {
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
      })

      $( "#fechadingr" ).click(function() {
        var ing = document.getElementById('ing').value;
          console.log('ress',ing);
            $.ajax({
                type: "GET",
                url: "/reporte_Ingreso_General/"+ing+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/reporte_Ingreso_General/'+ing+'';
                },
                error: function () {
                    alert("Error");
                }
            });
      })

      $( "#fechasal" ).click(function() {
      var idsal = document.getElementById('idsal').value;
          console.log('sal',idsal);
            $.ajax({
                type: "GET",
                url: "/reporte_Salida_General/"+idsal+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/reporte_Salida_General/'+idsal+'';
                },
                error: function () {
                    alert("Error");
                }
            });
      })

      $( "#mes" ).click(function() {
      var mesrpt = document.getElementById('mesrpt').value;
          console.log('mes',mesrpt);
            $.ajax({
                type: "GET",
                url: "/rptMensual/"+mesrpt+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/rptMensual/'+mesrpt+'';
                },
                error: function () {
                    alert("Error");
                }
            });
      })
    
      $( "#rangofechinv" ).click(function() {
      var rangoinv=$("#dia_inv_ini").val()+'/'+$("#dia_inv_fin").val();
          console.log ('rango',rangoinv);
            $.ajax({
                type: "GET",
                url: "/rptInventarioRango/"+rangoinv+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/rptInventarioRango/'+rangoinv+'';
                },
                error: function () {
                    alert("Error");
                }
            }); 
      })

      $( "#rangofechres" ).click(function() {
      var rangores=$("#id_res_ini").val()+'/'+$("#id_res_fin").val();
          console.log ('rango',rangores);
            $.ajax({
                type: "GET",
                url: "/rptResumidoRango/"+rangores+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/rptResumidoRango/'+rangores+'';
                },
                error: function () {
                    alert("Error");
                }
            }); 
      })

      $( "#rangofeching" ).click(function() {
      var rangoing=$("#dia_ing_ini").val()+'/'+$("#dia_ing_fin").val();
          console.log ('rango',rangoing);
            $.ajax({
                type: "GET",
                url: "/reporte_Ingreso_GeneralRango/"+rangoing+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/reporte_Ingreso_GeneralRango/'+rangoing+'';
                },
                error: function () {
                    alert("Error");
                }
            }); 
      })

      $( "#rangofechsal" ).click(function() {
      var rangosal=$("#dia_sal_ini").val()+'/'+$("#dia_sal_fin").val();
          console.log ('rango',rangosal);
            $.ajax({
                type: "GET",
                url: "/reporte_Salida_GeneralRango/"+rangosal+"",
                success: function () {
                    // alert(data.toString());
                     document.location.href = '/reporte_Salida_GeneralRango/'+rangosal+'';
                },
                error: function () {
                    alert("Error");
                }
            }); 
      })
    

     
      $( "#mostrar" ).click(function() {
        $('#inventario').show();
        $('#resumido').hide();
        $('#ingreso').hide();
        $('#salida').hide();
        $('#mensual').hide();
      })

      $( "#mostrar1" ).click(function() {
        $('#inventario').hide();
        $('#resumido').show(); 
        $('#ingreso').hide();
        $('#salida').hide();
        $('#mensual').hide();
      })

      $( "#mostrar2" ).click(function() {
        $('#inventario').hide();
        $('#resumido').hide(); 
        $('#salida').hide();
        $('#mensual').hide();
        $('#ingreso').show();
      })

      $( "#mostrar3" ).click(function() {
        $('#inventario').hide();
        $('#resumido').hide(); 
        $('#ingreso').hide();
        $('#mensual').hide();
        $('#salida').show();
      })

      $( "#mostrar4" ).click(function() {
        $('#inventario').hide();
        $('#resumido').hide(); 
        $('#ingreso').hide();
        $('#salida').hide();
        $('#mensual').show();
      })

//       function changeColor(x)
// {
//     if(x.style.background=="rgb(247, 211, 88)")
//     {
//         x.style.background="#fff";
//     }else{
//         x.style.background="#F7D358";
//     }
//     return false;
// }

    // });
  // $('.datepickerDays').datepicker({
  //       format: "dd/mm/yyyy",        
  //       language: "es",
  //   }).datepicker("setDate", new Date());  
  @endsection 
  {{-- @endsection --}}
</script>
{{-- @endpush --}}