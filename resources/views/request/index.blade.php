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
                        {{$title??'Solicitudes Recibidas '.Auth::user()->getStorage()->name}}
                        <small class="float-sm-right">
                            {{-- <a href="{{url('amp_report_excel')}}" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> </a>  --}}
                            {{-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ProviderModal" data-json="null" > Nuevo  <i class="fa fa-plus-circle"></i> </button> --}}
                        </small>
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="lista" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nro Nota solicitud</th>
                                <th>Fecha</th>
                                <th>Funcionario</th>
                                <th>Tipo de Solicitud</th>
                                <th>Origen de Solicitud</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($request_articles as $item)
                            <tr>
                                <td>{{$count++}}</td>
                                <td> <a href="#"  class="badge badge-primary" data-toggle="modal" data-target="#modalPdf" data-url="{{url('request_note/'.$item->id)}}">{{$item->correlative}}</a> </td>
                                <td> {{$item->created_at}} </td>
                                <td>{{$item->person->prs_nombres.' '.$item->person->prs_paterno.' '.$item->person->prs_materno}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->storage_origin->name}}</td>
                                <td>
                                    @switch($item->state)
                                        @case('Aprobado')
                                            <span class="badge badge-primary">{{$item->state}}</span>
                                            @break

                                        @case('Entregado')
                                            <span class="badge badge-success">{{$item->state}}</span>
                                            @break

                                        @case('Pendiente')
                                            <span class="badge badge-info">{{$item->state}}</span>
                                            @break
                                        @case('Rechazado')
                                            <span class="badge badge-danger">{{$item->state}}</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    {{-- <a href="{{url('action_short_term_year/'.$item->years[0]->id)}}"><i class="material-icons text-warning">folder</i></a> --}}
                                    {{-- {{$item}} --}}
                                    @if($item->state == 'Pendiente Aprobacion' )
                                        @if($item->type == 'Funcionario' )
                                            <a href="{{url('request/'.$item->id.'/edit')}}" ><i class="material-icons text-info">assignment</i></a>
                                        @else
                                            <a href="{{url('transfer_request_check/'.$item->id)}}" ><i class="material-icons text-info">assignment</i></a>
                                        @endif
                                    @endif
                                    @if($item->state == 'Aprobado')
                                        {{-- <a href="#" data-toggle="modal" data-target="#ProviderModal" data-json="{{$item}}"><i class="material-icons text-primary">local_shipping</i></a> --}}
                                        <a href="#"> <i class="material-icons text-primary delivery" data-json='{{$item}}'>local_shipping</i></a>
                                    @endif
                                    @if($item->state == 'Entregado')
                                        {{-- <a href="#" data-toggle="modal" data-target="#ProviderModal" data-json="{{$item}}"><i class="material-icons text-primary">local_shipping</i></a> --}}
                                        <a href="#" data-toggle="modal" data-target="#modalPdf" data-url="{{url('out_note/'.$item->id)}}"> <i class="material-icons text-success " data-json='{{$item}}'>remove_red_eye</i></a>
                                    @endif
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                            {{-- <div id='calendar'></div> --}}
                </div>
            </div>
        </div>

        {{-- aqui los modals --}}
        {{-- <provider-component url='{{url('provider')}}' csrf='{!! csrf_field('POST') !!}'></provider-component> --}}


    </div>

    <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="modalPdfTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPdfTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" width="100%" height="100%" frameborder="0" allowtransparency="true"></iframe>
            </div>
            </div>
        </div>
    </div>

@endsection
<script>

    @section('script')

        var url_flash = @json(session('url'));
        console.log('printer flash')
        console.log(url_flash);
        if(url_flash)
        {
            if(url_flash.length >0)
            {
                $('#modalPdf .modal-body iframe').attr('src', url_flash)
                $('#modalPdf').modal('show')
            }
        }


        $('#modalPdf').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var url = button.data('url') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            console.log(url);
            var modal = $(this)
            modal.find('.modal-title').text('' )
            modal.find('.modal-body iframe').attr('src', url)

        })
        var classname = document.getElementsByClassName("delivery");
        // console.log(classname);
        function deleteItem(){

            var data = JSON.parse(this.getAttribute("data-json"));
            console.log(data);
            Swal.fire({
            title: 'Entrega de articulos de solicitud '+data.correlative+'?',
            text: "una vez realizada esta accion no se podra revertir!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {

                axios.post(`request/delivery_request`,{data})
                    .then(response=>{
                        console.log(response.data);
                        location.reload();
                    })
                    .catch(error=>{
                        // handle error
                        Swal.fire(
                        'Error! contactese con soporte tecnico',
                        ''+error,
                        'error'
                        )
                        // console.log(error);
                    });


            }
            })

        }
        for (var i = 0; i < classname.length; i++) {
            classname[i].addEventListener('click', deleteItem, false);
        }
    @endsection
</script>
