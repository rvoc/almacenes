@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    {{-- aqui los modals --}}
    <transfer-component
        url='{{url('request')}}'
        csrf='{!! csrf_field('POST') !!}'
        :storage="{{Auth::user()->getStorage()}}"
        :storages="{{$storages}}"
        :usr="{{$user}}"
        {{-- :person={{Auth::user()->person()}} --}}
    >
    </transfer-component>

@endsection
