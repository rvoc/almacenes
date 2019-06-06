 @php

$articulos = \DB::table('sisme.article_histories')
                ->join('sisme.articles as art', 'sisme.article_histories.article_id', '=', 'art.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->join('sisme.article_income_items as ing', 'sisme.article_histories.article_income_item_id', '=', 'ing.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->leftjoin('sisme.article_request_items as sali', 'ing.article_income_id', '=', 'sali.article_request_id')
                ->select('art.code as codigo','art.name as detalle', 'cat.name as categoria','ing.cost as ingcost', 'uni.name as unidad', 'ing.quantity as ingcant', 'sali.quantity_apro as salcant')
                ->where('article_histories.type', 'Entrada')
                
                ->get();

$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();

$date=date('Y-m-d');

$almacen = DB::table('sisme.storages')->select('name')->get();
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
$tam=count($almacen) + 4 
@endphp
<html>
<table>
   <tr>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="12" style="text-align:center;"><h7><strong>EMPRESA BOLIVIANA DE ALIMENTOS</strong></h7></td>
   </tr>
   <tr>
   <td colspan="13" style="text-align:center;"><strong><h7>INGRESO ALMACEN: OFICINA CENTRAL</h7></strong></td>
   </tr>
</table>
<table>
    <tr>
      <td colspan="13" align="center"><strong><h1>DE: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="13"><strong><h1>Generado por: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table border="1">
  <thead class="table_head">
   <tr>
      <td align="center" width="10" rowspan="2"><strong>ALMACEN</strong></td>
      <td align="center" bgcolor="red" rowspan="2"><strong>N° Salida</strong></td>
      <td align="center" width="30" rowspan="2"><strong>CODIGO</strong></td>
      <td align="center" width="20" rowspan="2"><strong>ARTICULO</strong></td>
      <td align="center" width="20" rowspan="2"><strong>CANTIDAD</strong></td>
      <td align="center" width="20" rowspan="2"><strong>CANT. APROB.</strong></td>
   </tr>
  </thead>
  <tbody>
   <?php
    // {{-- @foreach($provinces->chunk(500) as $chunk) --}}
     $nro_mod = 0;

    ?>
  </tbody>
    {{-- @endforeach --}}
</table>

   {{-- <td colspan="3">Números de Teléfono</td> --}}
  {{--   <td><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></td> --}}

   
  {{--   <td><b>Bold cell</b></td>
    <td><strong>Bold cell</strong></td>

    
    <td><i>Italic cell</i></td>
 --}}
    <!-- Images -->
   {{--  <td><img src="img.jpg" /></td> --}}

</html>
