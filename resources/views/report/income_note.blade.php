@extends('layouts.print')

@section('content')

<br>
<table class="table-info align-top no-padding no-margins border">
    <tr>
        <td class="text-center bg-grey-darker text-xs text-white ">Responsable</td>
        {{-- <td colspan="3" class="text-xs uppercase">{{$persona}}</td> --}}
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Dependencia</td>
        {{-- <td colspan="3" class="text-xs uppercase">{{$gerencia}}</td> --}}
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Proveedor</td>
        {{-- <td class="text-xs uppercase">{{$article_income->provider->name}}</td> --}}
        <td  class="text-center bg-grey-darker text-xs text-white">Telefono </td>
        {{-- <td class="text-xs uppercase">{{$article_income->provider->phone}}</td> --}}
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Nota Remision</td>
        {{-- <td class="text-xs uppercase">{{$article_income->correlative}}</td> --}}
        <td  class="text-center bg-grey-darker text-xs text-white">Fecha </td>
        {{-- <td class="text-xs uppercase">{{$article_income->created_at}}</td> --}}
    </tr>
    <tr>
        <td  class="text-center bg-grey-darker text-xs text-white">Tipo</td>
        {{-- <td colspan="3" class="text-xs uppercase">{{$article_income->type}}</td> --}}

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
