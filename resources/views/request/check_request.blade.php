@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    <check-component
    url='{{url('request')}}'
    csrf='{!! csrf_field('POST') !!}'
    :articles="{{$article_request_items}}"
    :storage="{{Auth::user()->getStorage()}}"
    :request="{{$article_request}}"
    gerencia="{{Auth::user()->employee->management->name}}"
    :providers = "{{$providers}}"

    >
    </check-component>


@endsection
<script>


</script>
