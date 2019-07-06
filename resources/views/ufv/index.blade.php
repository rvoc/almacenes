@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header card-calendar">

                    <h4 class="card-title ">
                        Articulos General
                        <small class="float-sm-right">
                            <a href="{{url('report_excel_ufv')}}" class="btn btn-success btn-sm"><i class="fa fa-file" aria-hidden="true"></i> EXPORTAR EXCEL</a>
                            <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ArticleModal" data-json="null" > Nuevo  <i class="fa fa-plus-circle"></i> </button> -->
                        </small>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="lista_ufv" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Ufv</th>
                                <!-- <th>Unidad</th>
                                <th>Categoria</th>
                                <th>Partida</th>
                                <th>Estado</th>

                                <th>Opciones</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nro=0; ?>
                            @foreach ($ufvs as $ufv)
                            <?php $nro = $nro+1; ?>
                            <tr>
                                <td class="text-center">{{$nro}}</td>
                                <td class="text-center">{{$ufv->date}}</td>
                                <td class="text-center">{{$ufv->price}}</td>
                                <!-- <td>{{$ufv->price}}</td>
                                <td>{{$ufv->price}}</td>
                                <td>{{$ufv->price}}</td>
                                <td>{{$ufv->price}}</td>
                                <td>
                                    {{$ufv->price}}
                                </td> -->

                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                            {{-- <div id='calendar'></div> --}}
                </div>
            </div>
        </div>

        {{-- aqui los modals --}}
        <article-component url='{{url('article')}}' csrf='{!! csrf_field('POST') !!}' ></article-component>


    </div>

@endsection
<script>

    @section('script')
        
        $('#lista_ufv').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 10002, targets: 2 },
                { responsivePriority: 2, targets: -1 }
            ],
            language: spanish_lang,
        });
    @endsection
</script>
