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
                        Stock
                        <small class="float-sm-right">
                            {{-- <a href="{{url('amp_report_excel')}}" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> </a>  --}}
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ArticleModal" data-json="null" > Nuevo  <i class="fa fa-plus-circle"></i> </button>
                        </small>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="lista" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $item)
                            <tr>
                                <td>{{$item->article->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>0</td>

                                {{-- <td>
                                    <a href="#" data-toggle="modal" data-target="#ArticleModal" data-json="{{$item}}"><i class="material-icons text-primary">edit</i></a>
                                    @if($item->deleted_at==null)
                                    <a href="#"> <i class="material-icons text-success deleted" data-json='{{$item}}'>check_box</i></a>
                                    @else
                                    <a href="#"> <i class="material-icons text-danger enabled" data-json='{{$item}}'>check_box_outline_blank</i></a>
                                    @endif
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
        <article-component url='{{url('article')}}' csrf='{!! csrf_field('POST') !!}' ></article-component>


    </div>

@endsection
<script>

    @section('script')
        var classname = document.getElementsByClassName("deleted");
        var class_endabled = document.getElementsByClassName("enabled");
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
        function enabledItem(){

            var data = JSON.parse(this.getAttribute("data-json"));

            Swal.fire({
            title: 'Esta Seguro de Activar '+data.name+'?',
            text: "una vez inactivo se podra utilizar el articulo",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {

                axios.get(`article/${data.id}/edit`)
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
        for (var i = 0; i < class_endabled.length; i++) {
            class_endabled[i].addEventListener('click', enabledItem, false);
        }
    @endsection
</script>
