 @php
$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
$storage=Auth::user()->getStorage();
$almacen = DB::table('sisme.storages')->select('name')->where('id','=',$storage->id)->get();
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
$tam=count($almacen) + 4 
@endphp
<html>
<table>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="{{$tam-1}}" style="text-align:center; vertical-align: middle;"><h2>EMPRESA BOLIVIANA DE ALIMENTOS</h2></td>
</table>
<table>
    <tr>
      <td colspan="{{$tam}}"  align="center"><strong><h1>REPORTE GENERAL DE SALDOS</h1></strong></td>
    </tr>
     <tr>
      <td colspan="5" style="text-align:center;"><strong><h7>{{$storage->description}}</h7></strong></td>
    </tr>
    <tr>
      <td colspan="{{$tam}}" align="center"><strong><h1>FECHA DE EMISION: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="{{$tam}}"><strong><h1>GENERADO POR: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table>
  <thead class="table_head">
   <tr>
      <td align="center" width="10" style="background-color: #808080; border: 1px solid #000000;"><strong>N°</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>CODIGO</strong></td>
      <td align="center" width="30" style="background-color: #808080; border: 1px solid #000000;"><strong>DESCRIPCION</strong></td>
      <td align="center" width="35" style="background-color: #808080; border: 1px solid #000000;"><strong>UNIDAD</strong></td>
      @foreach($almacen as $alm)
      <td align="center" width="20" style="background-color: #808080; border: 1px solid #000000;"><strong>{{$alm->name}}</strong></td>
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
             echo   '<td align="center" style="border: 1px solid #000000;">',$nro_mod,'</td>';
             echo   '<td align="center" style="border: 1px solid #000000;">',$art->codigo,'</td>';
             echo   '<td align="center" style="border: 1px solid #000000;">',$art->detalle,'</td>';
             echo   '<td align="center" style="border: 1px solid #000000;">',$art->unidad,'</td>';
             echo   '<td align="center" style="border: 1px solid #000000;">',$art->quantity,'</td>';
             echo'</tr>';
        } 
    ?>
  </tbody>
    {{-- @endforeach --}}
</table>
</html>
