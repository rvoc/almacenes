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
                        {{$title??'Solicitudes de Modificiaciones'}}
                        <small class="float-sm-right">
                            {{-- <a href="{{url('amp_report_excel')}}" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> </a>  --}}
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#StorageModal" data-json="null" > Nuevo  <i class="fa fa-plus-circle"></i> </button>
                        </small>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-in"
                                role="tab" aria-controls="pills-in" aria-selected="true">Entradas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-out"
                                role="tab" aria-controls="pills-out" aria-selected="false">Salidas</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-in" role="tabpanel" aria-labelledby="pills-in-tab">
                            <table id="lista" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Nro Nota</th>
                                        <th>Tipo</th>
                                        <th>Descripcion</th>
                                        <th>Aprobacion Encargado</th>
                                        <th>Aprobacion Jefe</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_incomes as $index=> $item)
                                    <tr>
                                        <td>{{($index+1)}}</td>
                                        <td>{{$item->article_income->correlative}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <span class="badge badge-{{$item->is_aprobed_boss?'success':'secondary'}}">{{$item->is_aprobed_boss?'Aprobado':'Pendiente'}}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{$item->is_aprobed_boss2?'success':'secondary'}}">{{$item->is_aprobed_boss2?'Aprobado':'Pendiente'}}</span>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#RequestChangeIncomeModal" data-json="{{$item}}"><i class="material-icons text-primary">edit</i></a>
                                            {{-- <a href="#"> <i class="material-icons text-danger deleted" data-json='{{$item}}'>delete</i></a> --}}
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-out" role="tabpanel" aria-labelledby="pills-out-tab">

                        </div>

                    </div>

                            {{-- <div id='calendar'></div> --}}
                </div>
            </div>
        </div>

        {{-- aqui los modals --}}
        <change-income-edit url='{{url('storage')}}' csrf='{!! csrf_field('POST') !!}'></change-income-edit>


    </div>

@endsection
<script>

    @section('script')
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

                axios.delete(`storage/${data.id}`)
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
