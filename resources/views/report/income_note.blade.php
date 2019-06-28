@extends('layouts.print')

@section('content')
<br>
<table class="table-info align-top no-padding no-margins border">
    <tr>
        <td class="text-center bg-grey-darker text-xs text-white ">Responsable</td>
        <td colspan="3" class="text-xs uppercase">{{$persona}}</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Dependencia</td>
        <td colspan="3" class="text-xs uppercase">{{$gerencia}}</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Proveedor</td>
        <td class="text-xs uppercase">{{$article_income->provider->name}}</td>
        <td  class="text-center bg-grey-darker text-xs text-white">Telefono </td>
        <td class="text-xs uppercase">{{$article_income->provider->phone}}</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Nota Remision</td>
        <td class="text-xs uppercase">{{$article_income->remision_number}}</td>
        <td  class="text-center bg-grey-darker text-xs text-white">Fecha Remision</td>
        <td class="text-xs uppercase">{{$article_income->date}}</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Tipo</td>
        <td colspan="3" class="text-xs uppercase">{{$article_income->type}}</td>

    </tr>
</table>
<br>
<table class="table-info w-100">
    <thead class="bg-grey-darker">
        <tr class="font-medium text-white text-sm">
            <td class="px-15 py text-center text-xxs ">
                Nro.
            </td>
            <td class="px-15 py text-center  text-xxs">
                Unidad
            </td>
            <td class="px-15 py text-center text-xxs">
                Descripcion
            </td>
            <td class="px-15 py text-center text-xxs">
                Cantidad
            </td>
            <td class="px-15 py text-center text-xxs">
                Costo U
            </td>
            <td class="px-15 py text-center text-xxs">
                Costo Total
            </td>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        @foreach ($article_income->article_income_items as $item)
            <tr class="text-sm">
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $count }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article->unit->name }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article->name }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->quantity }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->cost }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{  $item->quantity * $item->cost }}</td>
            </tr>
            <?php $count++;?>
        @endforeach
            <tr class="text-sm">
                <td class="text-center text-xxs uppercase font-bold px-4 py-3 bg-grey-darker text-white" colspan="5">Total</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $article_income->total_cost}}</td>
            </tr>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<table>
    <tr>
        <td class="text-center">______________</td>
        <td class="text-center">______________</td>
    </tr>
    <tr>
        <td class="text-center text-xxs">Responsable de Almacen</td>
        <td class="text-center text-xxs">Area/Unidad Administrativa</td>
    </tr>
</table>

@endsection
