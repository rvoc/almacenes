@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    {{-- aqui los modals --}}

    <change-out
        url='{{url('store_out')}}'
        csrf='{!! csrf_field('POST') !!}'
        :requestout="{{$article_request}}"
        :stocks= "{{$stocks}}"
    >
    </change-out>

@endsection
