 @php

$articulos = \DB::table('sisme.stocks')
                ->join('sisme.articles as art', 'sisme.stocks.article_id', '=', 'art.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->select('art.code as codigo','art.name as detalle', 'uni.name as unidad', 'cat.name as categoria', 'stocks.article_id',DB::raw('sum(stocks.quantity) as quantity'))
                ->groupBy('stocks.article_id', 'codigo', 'detalle', 'unidad', 'categoria')
                ->get();

$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
$date=date('Y-m-d')
 @endphp
 <!DOCTYPE html>
<html>
<table>
   <tr>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="5" style="text-align:center; vertical-align: middle;"><strong>EMPRESA BOLIVIANA DE ALIMENTOS</strong></td>
   </tr>
</table>
<table>
    <tr>
      <td colspan="6"  align="center"><strong><h1>INVENTARIO OFICINA CENTRAL LA PAZ</h1></strong></td>
    </tr>
    <tr>
      <td colspan="6" align="center"><strong><h1>AL: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="6"><strong><h1>Generado por: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table >
  <thead class="table_head">
   <tr>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;" width="10"><strong>N°</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>CODIGO</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;" width="30"><strong>DETALLE ARTICULO</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>UNIDAD</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;" width="15"><strong>CATEGORIA</strong></td>
      <td align="center" style="background-color: #808080; border: 1px solid #000000;" width="15"><strong>CANTIDAD</strong></td>
   </tr>
  </thead>
  <tbody>
    {{ $tot=0 }}
    {{ $num=0 }}
    @foreach($articulos as $art)
    {{$num=$num+1}}
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{$num}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$art->codigo}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$art->detalle}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$art->unidad}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$art->categoria}}</td>
        <td align="center" style="border: 1px solid #000000;">{{$art->quantity}}</td>
      </tr>
      {{ $tot=$tot+$art->quantity }}
    @endforeach 
  </tbody>
  <tr align="center" BGCOLOR="#f3f0ff">
          <td colspan="5" align="center" style="background-color: #808080; border: 1px solid #000000;"><strong>TOTALES</strong></td>
          <td align="center" style="background-color: #808080; border: 2px solid #000000;">{{ $tot }}</td>                                        
      </tr>;
</table>
</html>
