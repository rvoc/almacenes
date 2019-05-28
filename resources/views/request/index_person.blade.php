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
                        {{$title??'Mis Solicitudes Realizadas'}}
                        <small class="float-sm-right">
                            <a href="{{url('request/create')}}" class="btn btn-primary btn-sm"> Nuevo Solicitud <i class="fa fa-plus-circle"></i> </a>
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
                                <th>Nº Solicitud</th>
                                <th>Nota Solicitud</th>
                                <th>Fecha</th>
                                <th>Almacen</th>
                                <th>Estado</th>
                                {{-- <th>Opciones</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($request_articles as $item)
                            <tr>
                                <td>{{$item->correlative}}</td>
                                <td> <a href="#"  class="badge badge-primary" data-toggle="modal" data-target="#modalPdf" data-url="{{url('request_note/'.$item->id)}}">{{$item->correlative}}</a> </td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->storage_destiny->name}}</td>
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
                                {{-- <td>
                                    <a href="#"data-toggle="modal" data-target="#modalPdf" data-url="{{url('request_note/'.$item->id)}}"><i class="material-icons text-primary">remove_red_eye</i></a>
                                </td> --}}

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
                <h5 class="modal-title" id="modalPdfTitle">Modal title</h5>
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

        var classname = document.getElementsByClassName("deleted");
        // console.log(classname);
        function deleteItem(){

            var data = JSON.parse(this.getAttribute("data-json"));

            Swal.fire({
            title: 'Esta Seguro de Eliminar '+data.name+'?',
            text: "una vez eliminado no se podra revertir la accion!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {

                axios.delete(`provider/${data.id}`)
                    .then(response=>{
                        console.log(response);
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
