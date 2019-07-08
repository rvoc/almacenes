@php
$user= DB::table('rrhh.employees')
                ->where('id','=',Auth::user()->usr_prs_id)
                ->first();
@endphp
<html>
<table>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="2" style="text-align:center; vertical-align: middle;"><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></td>
</table>
<table>
    <tr>
      <td colspan="3" style="text-align:center;"><strong><h7>CUADRO DE RESUMEN DEL MOVIMIENTO DE MATERIAL</h7></strong></td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;"><strong><h7></h7></strong></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><strong><h1></h1></strong></td>
    </tr>
      <tr>
      <td colspan="3"  align="center"><strong><h1>EXPRESADO EN BOLIVIANOS</h1></strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong><h1>GENERADO POR: {{$user->first_name}} {{$user->second_name}} {{$user->last_name}} {{$user->mother_last_name}}</h1></strong></td>
   </tr>
</table>
<table border="1">
  <thead class="table_head">
   <tr>
      <td width="15" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>N°</strong></td>
      <td rowspan="40" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>FECHA</strong></td>
      <td width="40" rowspan="2" align="center" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>UFV</strong></td>      
   </tr>
  </thead>
  <tbody>
  <?php $nro=0 ?>
  @foreach($ufvs as $ufv)
    <?php $nro=$nro+1; ?>
    <tr>
      <td align="center" style="border: 1px solid #000000;">{{$nro}}</td>
      <td align="center" style="border: 1px solid #000000;">{{$ufv->date}}</td>
      <td align="center" style="border: 1px solid #000000;">{{$ufv->price}}</td>
    </tr>
  @endforeach
  </tbody>

  

</table>
</html>