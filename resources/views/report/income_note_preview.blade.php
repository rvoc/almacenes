@extends('layouts.print')

@section('content')

<br>
<table class="table-info align-top no-padding no-margins border">
    <tr>
        <td class="text-center bg-grey-darker text-xs text-white ">Responsable</td>
        {{-- <td colspan="3" class="text-xs uppercase">{{$persona}}</td> --}}
    </tr>
    {{-- <tr> --}}
        {{-- <td  class="text-center bg-grey-darker text-xs text-white">Dependencia</td> --}}
        {{-- <td colspan="3" class="text-xs uppercase">{{$gerencia}}</td> --}}
    {{-- </tr> --}}
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Proveedor</td>
        <td class="text-xs uppercase">{{$provider}}</td>
        <td  class="text-center bg-grey-darker text-xs text-white">Telefono </td>
        {{-- <td class="text-xs uppercase">{{$article_income->provider->phone}}</td> --}}
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Nota Remision</td>
        <td class="text-xs uppercase">Sin nota</td>
        <td  class="text-center bg-grey-darker text-xs text-white">Fecha </td>
        <td class="text-xs uppercase">--</td>
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Tipo</td>
        <td colspan="3" class="text-xs uppercase">{{$type}}</td>

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
                Costo U
            </td>
            <td class="px-15 py text-center text-xxs">
                Cantidad
            </td>
            <td class="px-15 py text-center text-xxs">
                Costo Total
            </td>
        </tr>
    </thead>
    <tbody>
        <?php $total_quantity=0;
            $total_cost=0;
        ?>
        @foreach ($incomes as  $count => $item)
        <tr class="text-sm">
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $count++ }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article->unit->name??'' }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article->name }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->cost }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->quantity }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->cost * $item->quantity }}</td>
        </tr>
        <?php
            $total_quantity += $item->quantity;
            $total_cost +=  $item->cost * $item->quantity;
        ?>
        @endforeach
        <tr class="text-sm">
            <td class="text-center text-xxs uppercase font-bold px-4 py-3 bg-grey-darker text-white" colspan="4">Total</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $total_quantity}}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $total_cost}}</td>
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
