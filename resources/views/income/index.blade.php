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
                            <a href="{{url('income/create')}}" class="btn btn-success btn-sm">Nuevo  <i class="fa fa-plus-circle"></i></a>
                        </small>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="lista" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nro. Ingreso</th>
                                <th>Persona</th>
                                <th>Proveedor</th>
                                <th>Telefono</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $item)
                            <tr>
                                <td>{{$item->correlative}}</td>
                                <td>{{$item->person->prs_nombres.' '.$item->person->prs_paterno.' '.$item->person->prs_materno}}</td>
                                <td>{{$item->provider->name}}</td>
                                <td>{{$item->provider->phone}}</td>
                                <td>
                                    {{-- <a href="{{url('action_short_term_year/'.$item->years[0]->id)}}"><i class="material-icons text-warning">folder</i></a> --}}
                                    <a href="#" > <i class="material-icons text-info">description</i> </a>
                                    <a href="#" data-toggle="modal" data-target="#ArticleModal" data-json="{{$item}}"><i class="material-icons text-primary">edit</i></a>
                                    <a href="#"> <i class="material-icons text-danger deleted" data-json='{{$item}}'>delete</i></a>
                                </td>

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

@endsection
<script>

    @section('script')
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
