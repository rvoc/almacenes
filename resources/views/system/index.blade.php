@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">

                <div class="card-header card-calendar">

                    <h4 class="card-title ">
                        Sistemas
                        <small class="float-sm-right">
                        </small>
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#systemModal" data-json="{{$item}}"><i class="material-icons text-primary">edit</i></a>
                                    <a href="#"> <i class="material-icons text-danger enabled" data-json='{{$item}}'>delete</i></a>
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
        <div class="col">
            <div class="card">

                <div class="card-header card-calendar">

                    <h4 class="card-title ">

                        Roles
                        <small class="float-sm-right">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#RoleModal" data-json="null" > Nuevo  <i class="fa fa-plus-circle"></i> </button>
                        </small>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="lista" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Sistema</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @foreach ($item->getPermissionNames() as $name)
                                        <span class="badge badge-primary">{{$name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#RoleModal" data-json="{{$item}}"><i class="material-icons text-primary">edit</i></a>

                                    <a href="#"> <i class="material-icons text-danger enabled" data-json='{{$item}}'>delete</i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>
    {{-- importar componentes aqui --}}
    <role-edit url='{{url('store_role')}}' csrf='{!! csrf_field('POST') !!}' ></role-edit>

        {{-- <role-edit url='{{url('article')}}' csrf='{!! csrf_field('POST') !!}' :permissions = "{{$permissions}}" ></role-edit> --}}
        {{-- aqui los modals --}}
        <form method="post" action="{{url('store_system')}}" method="POST" >
            {{csrf_field('POST')}}
            <div class="modal fade" id="systemModal" tabindex="-1" role="dialog" aria-labelledby="systemModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="systemModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre del Sistema:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <input type="text" class="form-control" id="id" name="id" hidden>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

@endsection
<script>

    @section('script')

        $('#systemModal').on('show.bs.modal', function (event) {
                var button=$(event.relatedTarget) // Button that triggered the modal
                var data=button.data('json') // Extract info from data-* attributes
                console.log(data);
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal=$(this)
                    modal.find('.modal-title').text('Editando '+ data.name)
                    modal.find('.modal-body #name').val(data.name)
                    modal.find('.modal-body #id').val(data.id)
            }

        );

        // var classname = document.getElementsByClassName("deleted");
        // // console.log(classname);
        // function deleteItem(){

        //     var data = JSON.parse(this.getAttribute("data-json"));

        //     Swal.fire({
        //     title: 'Esta Seguro de Inactivar '+data.name+'?',
        //     text: "una vez inactivo no se podra utilizar el articulo!",
        //     type: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Si',
        //     cancelButtonText: 'No'
        //     }).then((result) => {
        //     if (result.value) {

        //         axios.delete(`article/${data.id}`)
        //             .then(response=>{
        //                 console.log(response);
        //                 location.reload();
        //             })
        //             .catch(error=>{
        //                 // handle error
        //                 Swal.fire(
        //                 'Error! contactese con soporte tecnico',
        //                 ''+error,
        //                 'error'
        //                 )
        //                 // console.log(error);
        //             });


        //     }
        //     })

        // }

        // for (var i = 0; i < classname.length; i++) {
        //     classname[i].addEventListener('click', deleteItem, false);
        // }

    @endsection
</script>
