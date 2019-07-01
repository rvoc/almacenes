@extends('layouts.app')
@section('breadcrums')
    {{ Breadcrumbs::render('home') }}
@endsection
@section('content')
@include('evaluacion')
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
          <h5>Solicitudes Aprobados</h5>
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
  </div>
@endsection
<script>
@section('script')
      // SCRIPT ESTRELLAS
  var slice = [].slice;

  (function($, window) {
    var Starrr;
    window.Starrr = Starrr = (function() {
      Starrr.prototype.defaults = {
        rating: void 0,
        max: 5,
        readOnly: false,
        emptyClass: 'far fa-star',
        fullClass: 'fas fa-star',
        change: function(e, value) {}
      };

      function Starrr($el, options) {
        this.options = $.extend({}, this.defaults, options);
        this.$el = $el;
        this.createStars();
        this.syncRating();
        if (this.options.readOnly) {
          return;
        }
        this.$el.on('mouseover.starrr', 'a', (function(_this) {
          return function(e) {
            return _this.syncRating(_this.getStars().index(e.currentTarget) + 1);
          };
        })(this));
        this.$el.on('mouseout.starrr', (function(_this) {
          return function() {
            return _this.syncRating();
          };
        })(this));
        this.$el.on('click.starrr', 'a', (function(_this) {
          return function(e) {
            e.preventDefault();
            return _this.setRating(_this.getStars().index(e.currentTarget) + 1);
          };
        })(this));
        this.$el.on('starrr:change', this.options.change);
      }

      Starrr.prototype.getStars = function() {
        return this.$el.find('a');
      };

      Starrr.prototype.createStars = function() {
        var j, ref, results;
        results = [];
        for (j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; 1 <= ref ? j++ : j--) {
          results.push(this.$el.append("<a id='estrella' href='#' />"));
          // results.push(this.$el.append("<a id='estrella' href='#' ><img src='img/esferas/esfera_"+j+".png' width='75px'></a>"));
        }
        return results;
      };

      Starrr.prototype.setRating = function(rating) {
        if (this.options.rating === rating) {
          rating = void 0;
        }
        this.options.rating = rating;
        this.syncRating();
        return this.$el.trigger('starrr:change', rating);
      };

      Starrr.prototype.getRating = function() {
        return this.options.rating;
      };

      Starrr.prototype.syncRating = function(rating) {
        var $stars, i, j, ref, results;
        rating || (rating = this.options.rating);
        $stars = this.getStars();
        results = [];
        for (i = j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
          results.push($stars.eq(i - 1).removeClass(rating >= i ? this.options.emptyClass : this.options.fullClass).addClass(rating >= i ? this.options.fullClass : this.options.emptyClass));
        }
        return results;
      };

      return Starrr;

    })();
    return $.fn.extend({
      starrr: function() {
        var args, option;
        option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
        return this.each(function() {
          var data;
          data = $(this).data('starrr');
          if (!data) {
            $(this).data('starrr', (data = new Starrr($(this), option)));
          }
          if (typeof option === 'string') {
            return data[option].apply(data, args);
          }
        });
      }
    });
  })(window.jQuery, window);
  // END SCRIPT ESTRELLAS
      $(document).ready(function() {
        // $('#modal_encuesta').modal('show');
        <?php 
      Session::put('EVALUACION','NO');
      use Illuminate\Support\Facades\DB;
      $eval_user = DB::table('public.evaluacion_sistema')->where('evalsis_id_usuario',Auth::user()->usr_id)->where('evalsis_id_sistema',2)->first(); 
      // echo Session::get('EVALUACION');
      if(!$eval_user AND Session::get('EVALUACION') == 'NO'){ ?>
          $('#modal_encuesta').modal('show');
        <?php } ?>

      });
      var valor_estrellas;
      $('#Estrellas').starrr({
        // rating:3,
        change:function(e,valor){
          // alert(valor);
          valor_estrellas = valor;
        }
      });
  $("#RegistrarEvaluacion").click(function(){
    <?php Session::forget('EVALUACION');
        Session::put('EVALUACION', 'SI'); ?>
    console.log("Registrar Evaluacion");
    var primera_respuesta = $('input:radio[name=o1]:checked').val();
    var segunda_respuesta = $('input:radio[name=o2]:checked').val();
    var tercera_respuesta = $('#sugerencia').val();
    var valoracion_estrellas = valor_estrellas;
    console.log('primera respuesta: '+primera_respuesta+', segunda respuesta: '+segunda_respuesta+', tercera respuesta: '+tercera_respuesta+', VALORACION: '+valoracion_estrellas);
    if (valoracion_estrellas == undefined) {
      // swal("Por favor","Debe dar su valoracion","warning");
      Swal.fire(
          'Por Favor',
          'Debe dar su valoracion',
          'question'
        )
                
    }else{
      // swal("Muchas Gracias","Esto ayudara para el mejoramiento del sistema","success")
      var route="RegistroEvalSistema";
      var token =$("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {
          'primera_respuesta':primera_respuesta,
          'segunda_respuesta':segunda_respuesta,
          'tercera_respuesta':tercera_respuesta,
          'valoracion':valoracion_estrellas,                
                },
        success: function(data){
          console.log(data);
          $("#modal_encuesta").modal('toggle');
          // swal({ 
          //                  title: "Muchas Gracias",
          //                  text: "Esto ayudará para el mejoramiento del sistema",
          //                  type: "success" 
          //               },function(){
          //                  location.reload();
          //           });
          Swal.fire(
            'Muchas Gracias!',
            'Esto ayudará para el mejoramiento del sistema!',
            'success'
          )
          // location.reload();
        },
        error: function(result)
        {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Vuelva intentar mas tarde!',
          })
        }
      }); 
    }

  });

  $("#NoEvaluar").click(function(){
    <?php Session::forget('EVALUACION'); 
        Session::put('EVALUACION','SI'); ?>
    // var route="RegistroEvalSistema";
    // var token =$("#token").val();
    // $.ajax({
    //  url: route,
    //  headers: {'X-CSRF-TOKEN': token},
    //  type: 'POST',
    //  dataType: 'json',
    //  data: {       
    //    'evaluacion_estado:':'B',               
  //           },
    //  success: function(data){
    //    console.log(data);
    //    $("#modal_encuesta").modal('toggle');
    //    swal({ 
  //                   title: "Muchas Gracias",
  //                   text: "Esto ayudará para el mejoramiento del sistema",
  //                   type: "success" 
  //               },function(){
  //                   location.reload();
  //               });
    //  },
    //  error: function(result)
    //  {
    //    swal("Opss..!", "Error al registrar el dato", "error");
    //  }
    // });  
  });

@endsection
</script>
<style>
.checkbox label:after,
.radio label:after {
  content: '';
  display: table;
  clear: both;
}

.checkbox .cr,
.radio .cr {
  position: relative;
  display: inline-block;
  border: 1px solid #a9a9a9;
  border-radius: .25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: .5em;
}

.radio .cr {
  border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
  position: absolute;
  font-size: .8em;
  line-height: 0;
  top: 50%;
  left: 20%;
}

.radio .cr .cr-icon {
  margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
  display: none;
}

.checkbox label input[type="checkbox"]+.cr>.cr-icon,
.radio label input[type="radio"]+.cr>.cr-icon {
  opacity: 0;
}

.checkbox label input[type="checkbox"]:checked+.cr>.cr-icon,
.radio label input[type="radio"]:checked+.cr>.cr-icon {
  opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled+.cr,
.radio label input[type="radio"]:disabled+.cr {
  opacity: .5;
}


/*STYLES ESTRELLAS */
.starrr {
  display: inline-block; 
}
.starrr a {
    font-size: 16px;
    padding: 0 1px;
    cursor: pointer;
    color: #FFD119;
    /*color: yellow !important;*/
    text-decoration: none; 
}
#estrella{
  color: #EECF0A;
}
/*END STYLE ESTRELLAS*/
</style>