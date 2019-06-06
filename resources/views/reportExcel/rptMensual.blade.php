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
   <td colspan="13" style="text-align:center;"><strong><h7>CUADRO DE RESUMEN DEL MOVIMIENTO DE MATERIAL Oficina Central</h7></strong></td>
   </tr>
</table>
<table>
    <tr>
      <td colspan="13" align="center"><strong><h1>DE: {{$date}}</h1></strong></td>
    </tr>
      <tr>
      <td colspan="13"  align="center"><strong><h1>EXPRESADO EN BOLIVIANOS</h1></strong></td>
    </tr>
    <tr>
      <td colspan="13"><strong><h1>Generado por: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table border="1">
  <thead class="table_head">
   <tr>
      <td align="center" width="10" rowspan="2"><strong>N°</strong></td>
      <td align="center" bgcolor="red" rowspan="2"><strong>CODIGO</strong></td>
      <td align="center" width="30" rowspan="2"><strong>DETALLE ARTICULO</strong></td>
      <td align="center" width="20" rowspan="2"><strong>CATEGORIA</strong></td>
      <td align="center" width="20" rowspan="2"><strong>Precio u.</strong></td>
      <td align="center" width="20" rowspan="2"><strong>Total</strong></td>
      <td align="center" width="20" rowspan="2"><strong>Unidad</strong></td>
      <td width="20" colspan="3" style="text-align:center;"><strong>CANTIDAD FISICA</strong></td>
      <td width="20" colspan="3" style="text-align:center;"><strong>COSTO</strong></td>
      <tr>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
      <td align="center"><strong>Entrada</strong></td>
      <td align="center"><strong>Salida</strong></td>
      <td align="center"><strong>Saldo</strong></td>
      <td align="center"><strong>Entrada</strong></td>
      <td align="center"><strong>Salida</strong></td>
      <td align="center"><strong>Saldo</strong></td>
      </tr>
   </tr>
  </thead>
  <tbody>
   <?php
    // {{-- @foreach($provinces->chunk(500) as $chunk) --}}
     $nro_mod = 0;
        foreach($articulos as $art){
         $nro_mod = $nro_mod +1;
             echo '<tr>';
             echo   '<td>',$nro_mod,'</td>';
             echo   '<td>',$art->codigo,'</td>';
             echo   '<td>',$art->detalle,'</td>';
             echo   '<td>',$art->categoria,'</td>';
             echo   '<td>',$art->ingcost,'</td>';
             echo   '<td>','','</td>';
             echo   '<td>',$art->unidad,'</td>';
             echo   '<td>',$art->ingcant,'</td>';
             echo   '<td>',$art->salcant,'</td>';
             echo'</tr>';
        } 
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
