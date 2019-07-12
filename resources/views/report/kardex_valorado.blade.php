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

            <td colspan="3" class="px-15 py text-center text-xxs">
                Entrada
            </td>
            <td colspan="3" class="px-15 py text-center text-xxs">
                Salida
            </td>
            <td colspan="3" class="px-15 py text-center text-xxs">
                Saldo
            </td>
        </tr>
        <tr class="font-medium text-white text-sm">
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
            <td class="px-15 py text-center  text-xxs">C.U.</td>
            <td class="px-15 py text-center  text-xxs">Total </td>

        </tr>
    </thead>
    <tbody>

        @foreach ($history as $item)
            <tr class="text-sm">
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $count++ }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{Carbon\Carbon::parse($item->created_at, 'UTC')->format('d-m-Y')}}</td>
                @if($item->article_income_item_id!=null and $item->type == 'Entrada')
                    <td class="text-center text-xxxs font-bold px-5 py-3">{{ $item->type .' (NIº'.$item->article_income_item->article_income->correlative.')' }}</td>
                @else
                    <td class="text-center text-xxxs font-bold px-5 py-3">{{ $item->type .' (NSº '.$item->article_request_item->article_request->correlative.')' }}</td>
                @endif
                @if($item->article_income_item_id !=null and $item->type == 'Entrada')
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->quantity }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->quantity * $item->article_income_item->cost}}</td>
                @else
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                @endif

                @if($item->article_request_item_id !=null)
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->quantity_desc }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->quantity_desc * $item->article_income_item->cost }}</td>
                @else
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                @endif

                @if($item->type == 'Entrada')
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->quantity }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost }}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->quantity * $item->article_income_item->cost}}</td>
                @else
                    <?php
                        $income_item =  $income_items->where('id',$item->article_income_item_id)->first();
                        $income_item->quantity = $income_item->quantity - $item->quantity_desc
                    ?>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $income_item->quantity}}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost}}</td>
                    <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $income_item->quantity *  $item->article_income_item->cost }}</td>
                    {{-- @if($item->quantity_desc >= $item->article_request_item->quantity_apro )
                        <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ 0}}</td>
                        <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost }}</td>
                        <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ 0* $item->article_income_item->cost }}</td>
                    @else

                        <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_request_item->quantity_apro-= $item->quantity_desc }}</td>
                        <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_income_item->cost }}</td>
                        <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $item->article_request_item->quantity_apro * $item->article_income_item->cost }}</td>
                    @endif --}}
                @endif

            </tr>
        @endforeach
        {{-- @foreach ($stocks as $stock)
        <tr class="text-sm bg-grey-darker  text-white">
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $count++ }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{Carbon\Carbon::parse($stock->created_at, 'UTC')->format('d-m-Y')}}</td>
                <td class="text-center text-xxxs font-bold px-5 py-3">{{ 'Entrada (NIº'.$stock->article_income_item->article_income->correlative.')' }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->quantity }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->cost }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->quantity * $stock->cost}}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">-</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->quantity }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->cost }}</td>
                <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->quantity * $stock->cost}}</td>
        </tr>

        @endforeach --}}
    </tbody>
</table>
<br>
<table class="table-info w-100">
    <thead class="bg-grey-darker">
        {{-- <tr class="font-medium text-white text-sm">
            <td colspan="5" class="px-15 py text-center text-xxs ">
                    Resumen datos Actual
            </td>
        </tr> --}}
        <tr class="font-medium text-white text-sm">
            <td rowspan="1" class="px-15 py text-center text-xxs ">
                Nro.
            </td>
            <td rowspan="1" class="px-15 py text-center  text-xxs">
                Fecha Ingreso/Movimiento
            </td>


            <td colspan="3" class="px-15 py text-center text-xxs">
                Resumen de Saldos
            </td>

        </tr>
        <tr class="font-medium text-white text-sm">
            <td class="px-15 py text-center  text-xxs"></td>
            <td class="px-15 py text-center  text-xxs"></td>
            <td class="px-15 py text-center  text-xxs">Cant.</td>
            <td class="px-15 py text-center  text-xxs">C.U.</td>
            <td class="px-15 py text-center  text-xxs">Total </td>

        </tr>
    </thead>
    <tbody>
        @php
         $total_quantity=0;
         $total_cost=0;
         $total_amount=0;
         $count = 1;
        @endphp
        @foreach ($stocks as $index => $stock)
        <tr class="text-sm">
            <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $count++ }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{Carbon\Carbon::parse($stock->updated_at, 'UTC')->format('d-m-Y')}}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->quantity }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->cost }}</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3">{{ $stock->quantity * $stock->cost}}</td>
            @php
              $total_quantity += $stock->quantity;
              $total_cost += $stock->cost;
              $total_amount +=  $stock->quantity * $stock->cost;
            @endphp
        </tr>
        @endforeach
        <tr class="text-sm">
            <td colspan="2" class="text-center text-xxs uppercase font-bold px-5 py-3 bg-grey-darker text-white" >TOTAL:</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $total_quantity }}</td>
            {{-- <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $total_cost / sizeof($stocks) }}</td> --}}
            <td class="text-center text-xxs uppercase font-bold px-5 py-3" >-</td>
            <td class="text-center text-xxs uppercase font-bold px-5 py-3" >{{ $total_amount }}</td>
        </tr>
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
