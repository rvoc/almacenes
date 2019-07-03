@php
$user= DB::table('rrhh.employees')
                ->where('id','=',Auth::user()->usr_prs_id)
                ->first();
$storage=Auth::user()->getStorage();
$almacen = DB::table('sisme.storages')->select('id','name')->get();
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
//echo $almacen;
$tam1=count($almacen);
//echo $tam1;
$tam=count($almacen) + 4; 

function obtenerCantAlm($storage,$articulo,$date)
{
   $cantidad_alm = 0;
   $almacen = DB::table('sisme.stocks')
                   // ->join('sisme.stocks as stock','sisme.storages.id','=','stock.storage_id')
                    ->select('stocks.storage_id','stocks.article_id', DB::raw('sum(stocks.quantity) as quantity'))
                    ->where(DB::raw('cast(stocks.created_at as date)'),'=',$date)
                    ->groupBy('stocks.storage_id', 'stocks.article_id')
                    ->get();
         //  return $almacen;
            foreach ($almacen as $alm) {
            if ($alm->storage_id == $storage && $alm->article_id == $articulo) {
               $cantidad_alm = $alm->quantity;
            }
        }
        return $cantidad_alm;
}
@endphp
<html>
<table>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="{{$tam-1}}" style="text-align:center; vertical-align: middle;"><h2>EMPRESA BOLIVIANA DE ALIMENTOS</h2></td>
</table>
<table>
    <tr>
      <td colspan="{{$tam}}"  align="center"><strong><h1>REPORTE GENERAL RESUMIDO DE SALDOS</h1></strong></td>
    </tr>
    {{--  <tr>
      <td colspan="5" style="text-align:center;"><strong><h7>{{$storage->description}}</h7></strong></td>
    </tr> --}}
    <tr>
      <td colspan="{{$tam}}" align="center"><strong><h1>FECHA DE EMISION: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="{{$tam}}"><strong><h1>GENERADO POR: {{$user->first_name}} {{$user->second_name}} {{$user->last_name}} {{$user->mother_last_name}}</h1></strong></td>
   </tr>
</table>
<table id="Tabla1">
  <thead class="table_head">
   <tr>
      <td align="center" width="10" style="background-color: #808080; border: 1px solid #000000;"><strong>N°</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>CODIGO</strong></td>
      <td align="center" width="30" style="background-color: #808080; border: 1px solid #000000;"><strong>DESCRIPCION</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>UNIDAD</strong></td>
      @foreach($almacen as $alm)
      <td align="center" width="20" style="background-color: #808080; border: 1px solid #000000;"><strong>{{$alm->name}}</strong></td>
      @endforeach 
   </tr>
  </thead>
  <tbody>
   <?php
     $nro_mod = 0;
        foreach($articulos as $art){
        $nro_mod = $nro_mod +1;
             echo '<tr>'; 
              echo   '<td align="center" style="border: 1px solid #000000;">',$nro_mod,'</td>';
              echo   '<td align="center" style="border: 1px solid #000000;">',$art->codigo,'</td>';
              echo   '<td align="center" style="border: 1px solid #000000;">',$art->detalle,'</td>';
              echo   '<td align="center" style="border: 1px solid #000000;">',$art->unidad,'</td>';
              foreach($almacen as $alm){
                $cantidad = obtenerCantAlm($alm->id, $art->article_id, $date);
              echo   '<td align="center" style="border: 1px solid #000000;">',$cantidad,'</td>';
              }
             echo'</tr>';   
        }
    ?>
  </tbody>
</table>
</html>
{{-- @push('scripts') --}}
<script>
//va=document.getElementById("Tabla1").rows[4].cells[5].innerHTML = "<p>Algo dfsdfsdfsdfsfsd<b>HTML</b></p>";  
//console.log(va);
</script>
{{-- @endpush   --}}
