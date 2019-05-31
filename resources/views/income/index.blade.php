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
                        Ingresos {{Auth::user()->getStorage()->name}}
                        <small class="float-sm-right">
                            <a href="{{url('income/create')}}" class="btn btn-success btn-sm">Nuevo Ingreso  <i class="fa fa-plus-circle"></i></a>
                        </small>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="lista" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nro Nota Ingreso</th>
                                <th>Acta de Recpcion</th>
                                <th>Factura</th>
                                <th>Fecha Registro</th>
                                <th>Persona</th>
                                <th>Proveedor</th>
                                <th>Costo</th>
                                <th>Cantidad Articulos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $item)
                            <tr>
                                <td>{{$count++}}</td>
                                <td><a href="#"  class="badge badge-primary" data-toggle="modal" data-target="#modalPdf" data-url="{{url('income_note/'.$item->id)}}">{{$item->correlative}}</a>
                                </td>
                                <td><a href="#">{{$item->correlative}}</a> </td>
                                <td><a href="#">{{$item->path_invoice}}</a> </td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->person->prs_nombres.' '.$item->person->prs_paterno.' '.$item->person->prs_materno}}</td>
                                <td>{{$item->provider->name}}</td>
                                <td>{{$item->total_cost}}</td>
                                <td>{{$item->getTotalQuantity()}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        {{-- aqui los modals --}}
        {{-- <article-component url='{{url('article')}}' csrf='{!! csrf_field('POST') !!}' ></article-component> --}}


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

        var classname = document.getElementsByClassName("deleted");
        // console.log(classname);
        function deleteItem(){

            var data = JSON.parse(this.getAttribute("data-json"));

            Swal.fire({
            title: 'Esta Seguro de Inactivar '+data.name+'?',
            text: "una vez inactivo no se podra utilizar el articulo!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {

                axios.delete(`article/${data.id}`)
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
