@extends('layouts.print')

@section('content')
<br>
<table class="table-info align-top no-padding no-margins border">
    <tr>
        <td class="text-center bg-grey-darker text-xs text-white ">Articulo</td>
    <td colspan="3" class="text-xs uppercase">{{$article->name}}</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Unidad</td>
    <td colspan="3" class="text-xs uppercase">{{$article->unit->name}}</td>
    </tr>

</table>
<br>
<table class="table-info w-100">
    <thead class="bg-grey-darker">
        <tr class="font-medium text-white text-sm">
            <td rowspan="1" class="px-15 py text-center text-xxs ">
                Nro.
            </td>
            <td rowspan="1" class="px-15 py text-center  text-xxs">
                Fecha
            </td>
            <td rowspan="1" class="px-15 py text-center text-xxs">
                Detalle
            </td>
            <td rowspan="1" class="px-15 py text-center text-xxs">
                Articulo
            </td>
            <td colspan="3" class="px-15 py text-center text-xxs">
                Entrada
            </td>
            <td colspan="3" class="px-15 py text-center text-xxs">
                Salida
            </td>
            <td class="px-15 py text-center text-xxs">
                Saldo
            </td>
        </tr>
        <tr class="font-medium text-white text-sm">
            <td class="px-15 py text-center  text-xxs"></td>
            <td class="px-15 py text-center  text-xxs"></td>
            <td class="px-15 py text-center  text-xxs"></td>
            <td class="px-15 py text-center  text-xxs"></td>
            <td class="px-15 py text-center  text-xxs">Cant.</td>
            <td class="px-15 py text-center  text-xxs">C.U.</td>
            <td class="px-15 py text-center  text-xxs">Total </td>
            <td class="px-15 py text-center  text-xxs">Cant.</td>
            <td class="px-15 py text-center  text-xxs">C.U.</td>
            <td class="px-15 py text-center  text-xxs">Total </td>
            <td class="px-15 py text-center  text-xxs">Cant.</td>

        </tr>
    </thead>
    <tbody>

        @foreach ($history as $item)
            <tr class="text-sm">
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $count++ }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->created_at }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->type }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article->name }}</td>
                @if($item->article_income_item_id !=null)
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->quantity }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->quantity * $item->article_income_item->cost}}</td>
                @else
                <td></td>
                <td></td>
                <td></td>
                @endif

                @if($item->article_request_item_id !=null)
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_request_item->quantity_apro }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_request_item->quantity_apro??'' }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_request_item->quantity_apro??'' }}</td>
                @else
                <td></td>
                <td></td>
                <td></td>
                @endif

                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->stock_quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<br>
<br>
<table>
    <tr>
        <td class="text-right text-xxs">Revisado por firma</td>
        <td class="text-left text-xxs">  .......................................</td>
        <td class="text-right text-xxs">Verificado por firma</td>
        <td class="text-left text-xxs">  .......................................</td>
    </tr>

</table>
<br>
<table>
    <tr>
        <td class="text-right text-xxs">Nombre</td>
        <td class="text-left text-xxs">  .......................................</td>
        <td class="text-right text-xxs">Nombre</td>
        <td class="text-left text-xxs">  .......................................</td>
    </tr>
</table>

@endsection
