 @php


$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();

$date=date('Y-m-d');

$almacen = DB::table('sisme.storages')->select('name')->get();
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
$tam=count($almacen) + 4;
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
      <td colspan="13" style="text-align:center;"><strong><h7>ALMACEN: Oficina Central La Paz</h7></strong></td>
    </tr>
    <tr>
      <td colspan="13" align="center"><strong><h1>MES: {{$mes}}</h1></strong></td>
    </tr>
      <tr>
      <td colspan="13"  align="center"><strong><h1>EXPRESADO EN BOLIVIANOS</h1></strong></td>
    </tr>
    <tr>
      <td colspan="13"><strong><h1>GENERADO POR: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
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
         $total= $art->ingcost*$art->quantitytot;
         $saldo1=$art->quantitytot-$art->quantity;
         $entrada1=$art->ingcost*$art->quantitytot;
         $salida1=$art->ingcost*$art->quantity;
         $total1=$entrada1-$salida1;
             echo '<tr>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$nro_mod,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->codigo,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->detalle,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->categoria,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->ingcost,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$total,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->unidad,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->quantitytot,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$art->quantity,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$saldo1,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$entrada1,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$salida1,'</td>';
             echo   '<td  align="center" style="border: 1px solid #000000;">',$total1,'</td>';
             echo'</tr>';
           $totaCost=$totaCost+$entrada1;
           $totaSalida=$totaSalida+$salida1;
           $totaSaldo=$totaSaldo+$total1;
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

   {{-- <td colspan="3">Números de Teléfono</td> --}}
  {{--   <td><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></td> --}}

   
  {{--   <td><b>Bold cell</b></td>
    <td><strong>Bold cell</strong></td>

    
    <td><i>Italic cell</i></td>
 --}}
    <!-- Images -->
   {{--  <td><img src="img.jpg" /></td> --}}

</html>
