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
$date=date('Y-m-d')
 @endphp
<html>
<table>
   <tr>
      <td><img src="img/logo_small.jpg" width="100" /></td>
      <td colspan="4" style="text-align:center;"><strong><h1>EMPRESA BOLIVIANA DE ALIMENTOS</h1></strong></td>
   </tr>
</table>
<table>
    <tr>
      <td colspan="5"  align="center"><strong><h1>INVENTARIO OFICINA CENTRAL LA PAZ</h1></strong></td>
    </tr>
    <tr>
      <td colspan="5" align="center"><strong><h1>AL: {{$date}}</h1></strong></td>
    </tr>
    <tr>
      <td colspan="5"><strong><h1>Generado por: {{$user->prs_nombres}} {{$user->prs_paterno}} {{$user->prs_materno}}</h1></strong></td>
   </tr>
</table>
<table>
  <thead class="table_head">
   <tr>
      <td align="center"><strong>Codigo</strong></td>
      <td align="center" width="30"><strong>Detalle Articulo</strong></td>
      <td align="center"><strong>Unidad</strong></td>
      <td align="center"><strong>Cantidad</strong></td>
      <td align="center" width="20"><strong>Categoria</strong></td>
   </tr>
  </thead>
  <tbody>
    {{-- @foreach($provinces->chunk(500) as $chunk) --}}
        @foreach($articulos as $art)
            <tr>
                <td>{{$art->codigo}}</td>
                <td>{{$art->detalle}}</td>
                <td>{{$art->unidad}}</td>
                <td>{{$art->quantity}}</td>
                <td>{{$art->categoria}}</td>
            </tr>
        @endforeach 
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
