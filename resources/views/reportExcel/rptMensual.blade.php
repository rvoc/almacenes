 @php
$user= DB::table('rrhh.employees')
                ->where('id','=',Auth::user()->usr_prs_id)
                ->first();

$date=date('Y-m-d');

$almacen = DB::table('sisme.storages')->select('name')->get();
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
$tam=count($almacen) + 4;
$storage=Auth::user()->getStorage();
$cantidad_insumo = 0;
function obtenerSalidas($id_insumo)
{
       $storage=Auth::user()->getStorage();
       $cantidad_insumo = 0;
        $salida = \DB::table('sisme.article_histories')
            ->select('article_histories.article_id','article_histories.storage_id','article_histories.type','article_histories.article_income_item_id','article_histories.article_request_item_id', 'article_histories.quantity_desc')
            ->where('type', 'Salida')
            ->where('article_histories.storage_id','=',$storage->id)
            ->orderby('article_histories.article_request_item_id')
            ->get();
            foreach ($salida as $sal) {
            if ($sal->article_income_item_id == $id_insumo) {
              $cantidad_insumo = $cantidad_insumo + $sal->quantity_desc;
            }
        }
        return $cantidad_insumo;
}
@endphp
<html>
<table>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="12" style="text-align:center; vertical-align: middle;"><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></td>
</table>
<table>
    <tr>
      <td colspan="13" style="text-align:center;"><strong><h7>CUADRO DE RESUMEN DEL MOVIMIENTO DE MATERIAL</h7></strong></td>
    </tr>
    <tr>
      <td colspan="13" style="text-align:center;"><strong><h7>{{$storage->description}}</h7></strong></td>
    </tr>
    <tr>
      <td colspan="13" align="center"><strong><h1>MES: {{$mes}}</h1></strong></td>
    </tr>
      <tr>
      <td colspan="13"  align="center"><strong><h1>EXPRESADO EN BOLIVIANOS</h1></strong></td>
    </tr>
    <tr>
      <td colspan="13"><strong><h1>GENERADO POR: {{$user->first_name}} {{$user->second_name}} {{$user->last_name}} {{$user->mother_last_name}}</h1></strong></td>
   </tr>
</table>
<table border="1">
  <thead class="table_head">
   <tr>
      <td width="10" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>N°</strong></td>
      <td rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>CODIGO</strong></td>
      <td width="30" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>DETALLE ARTICULO</strong></td>
      <td width="20" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>CATEGORIA</strong></td>
      <td width="20" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>PRECIO U.</strong></td>
      <td width="20" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>TOTAL</strong></td>
      <td width="20" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>UNIDAD</strong></td>
      <td width="20" colspan="3" align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>CANTIDAD FISICA</strong></td>
      <td width="20" colspan="3" align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>COSTO</strong></td>
      <tr>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
        <td align="center"><strong></strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>Entrada</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>Salida</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>Saldo</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>Entrada</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>Salida</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>Saldo</strong></td>
      </tr>
   </tr>
  </thead>
  <tbody>
   <?php
    // {{-- @foreach($provinces->chunk(500) as $chunk) --}}
   
     $nro_mod = 0;
     $totaCost = 0;
     $totaSalida = 0;
     $totaSaldo = 0;
        foreach($articulos as $art){
        $nro_mod = $nro_mod +1;
        $total = $art->ingcost*$art->quantitytot;
        $salidas = obtenerSalidas($art->idng);
        $totcant = $art->quantitytot-$salidas;
        $salcost = $salidas*$art->ingcost;
        $totcost = $total-$salcost;
             echo '<tr>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$nro_mod,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->codigo,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->detalle,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->categoria,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->ingcost,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$total,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->unidad,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->quantitytot,'</td>';//
             echo   '<td  align="center" style="border: 1px solid #000000;">',$salidas,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$totcant,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$total,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$salcost,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$totcost,'</td>';
             echo'</tr>';
          $totaCost=$totaCost+$total;
          $totaSalida=$totaSalida+$salcost;
          $totaSaldo=$totaSaldo+$totcost;
        } 
    ?>
  </tbody>
<tr>
  <td colspan="10" align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>TOTALES</strong></td>
  <td align="center" style="background-color: #808080; border: 1px solid #000000;">{{$totaCost}}</td>
  <td align="center" style="background-color: #808080; border: 1px solid #000000;">{{$totaSalida}}</td>
  <td align="center" style="background-color: #808080; border: 1px solid #000000;">{{$totaSaldo}}</td>                                            
</tr>; 
  
    {{-- @endforeach --}}
</table>
</html>
 @php


@endphp
