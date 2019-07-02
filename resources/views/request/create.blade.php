@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    {{-- aqui los modals --}}
    <request-component
        url='{{url('request')}}'
        csrf='{!! csrf_field('POST') !!}'
        :articles="{{$articles}}"
        :storage="{{Auth::user()->getStorage()}}"
        :request="{{$article_request}}"
        gerencia="{{Auth::user()->getGerencia()}}"

    >
    </request-component>

@endsection
