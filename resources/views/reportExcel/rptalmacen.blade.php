@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
            {{-- <div class="col-md-12">
                <div class="col-md-8">
                     <h3><label for="box-title">Almacenes</label></h3>
                </div>
            </div> --}}
             <div class="card-header card-calendar">

                    <h4 class="card-title ">
                        Almacenes
                    </h4>
                </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group">
                    <select class="form-control" id="alm" name="alm" onchange="listaralmacen();">
                        <option>Seleccione Almacen</option>
                        @foreach($data as $dat)
                        <option value="{{$dat->id}}">{{$dat->name}}</option>
                        {{-- <option value=""></option> --}}
                        @endforeach
                    </select>
                    </div>                            
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="col-md-12 table-bordered table-striped table-condensed cf" id="lts-alamacen" style="width:100%">
                            <thead class="cf">
                                <tr>
                                    <th>
                                        N°
                                    </th>
                                    <th>
                                        N° Nota de Ingreso
                                    </th>
                                    <th>
                                        Codigo
                                    </th>
                                     <th>
                                        Articulo
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Costo
                                    </th>
                                </tr>
                            </thead>
                            <tr>
                            </tr>
                    </table>
                </div>    
            </div>
    </div>
</div>
@endsection
{{-- @push('scripts') --}}
<script>
 @section('script')
// $(document).ready(function() {
//     listaralmacen();
// });
function listaralmacen(){
var id= document.getElementById("alm").value;
cosole.log(id);
    $('#lts-alamacen').DataTable( {
            "responsive": true,
            "processing": true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            // "ajax": "/listalmacenes/create",
            "ajax":{
               url : "/listalmacenes1/"+$("#alm").val(),
               type: "GET",
               // data: {"mes": $("#id_mes").val()}
             },
            "columns":[
                {data: 'id'},
                {data: 'article_id'},
                {data: 'storage_id'},
                {data: 'article_income_item_id'},
                {data: 'quantity'},
                {data: 'cost'},
        ],
        
        "language": {
             "url": "/lenguaje"
        },

        "paging":   false,
        "ordering": false,
        "info":     false,
        "dom" : 'Bfrtip',
        "buttons" : [
            {
                extend: 'excelHtml5',
                title: 'EXCEL REPORTE ACOPIO'
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                title: 'REPORTE ACOPIO',
               
                        
                        
      
            }
        ]

       
    });
}
 @endsection
</script>
{{-- @endpush --}}