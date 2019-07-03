@php

$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
$storage=Auth::user()->getStorage();
$almacen = DB::table('sisme.storages')->select('name')->get();
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
$tam=count($almacen) + 4 
@endphp
<html>
<table>
  <td><img src="img/logo_small.jpg" width="100" /></td>
  <td colspan="6" style="text-align:center; vertical-align: middle;"><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></td>
</table>
<table>
    <tr>
       <td colspan="7" style="text-align:center;"><strong<h7>INGRESO GENERAL {{$storage->description}}</h7></strong></td>
    </tr>
    <tr>
      <td colspan="7" align="center"><strong><h1>DE: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="7"><strong><h1>GENERADO POR: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table border="1">
  <thead class="table_head">
   <tr>
     <td align="center" width="10" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>N°</strong></td>
      <td align="center" width="30" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>ALMACEN</strong></td>
      <td align="center" width="18" bgcolor="red" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>N° INGRESO</strong></td>
      <td align="center" width="15" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>CODIGO</strong></td>
      <td align="center" width="40" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>ARTICULO</strong></td>
      <td align="center" width="20" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>CANTIDAD</strong></td>
      <td align="center" width="20" style="background-color: #808080; border: 1px solid #000000; vertical-align: middle;"><strong>COSTO</strong></td>
   </tr>
  </thead>
  <tbody>  
    {{$num=0}}
    @foreach($ingresos as $ing)
    {{$num=$num+1}}
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{$num}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$ing->almacen}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$ing->num}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$ing->codigo}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$ing->articulo}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$ing->cantidad}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$ing->costo}}</td>
      </tr>
    @endforeach 
  </tbody>
</table>
</html>
