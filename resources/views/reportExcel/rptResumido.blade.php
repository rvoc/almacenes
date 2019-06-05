 @php

$articulos = \DB::table('sisme.stocks')
                ->join('sisme.articles as art', 'sisme.stocks.article_id', '=', 'art.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->select('art.code as codigo','art.name as detalle', 'uni.name as unidad', 'cat.name as categoria', 'stocks.article_id',DB::raw('sum(stocks.quantity) as quantity'))
                ->groupBy('stocks.article_id', 'codigo', 'detalle', 'unidad', 'categoria')
                ->get();

$user= DB::table('siscor._bp_personas')
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
      <td colspan="{{$tam-1}}" style="text-align:center;"><strong><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></strong></td>
   </tr>
</table>
<table>
    <tr>
      <td colspan="{{$tam}}"  align="center"><strong><h1>REPORTE GENERAL DE SALDOS</h1></strong></td>
    </tr>
    <tr>
      <td colspan="{{$tam}}" align="center"><strong><h1>FECHA DE EMISION: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="{{$tam}}"><strong><h1>Generado por: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table>
  <thead class="table_head">
   <tr>
      <td align="center" width="10"><strong>N°</strong></td>
      <td align="center" bgcolor="red"><strong>CODIGO</strong></td>
      <td align="center" width="30"><strong>DESCRIPCION</strong></td>
      <td align="center"><strong>UNIDAD</strong></td>
      @foreach($almacen as $alm)
      <td align="center" width="20"><strong>{{$alm->name}}</strong></td>
      @endforeach 
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
             echo   '<td>',$art->unidad,'</td>';
             echo   '<td>',$art->quantity,'</td>';
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
