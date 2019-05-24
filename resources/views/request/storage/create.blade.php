@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    <transfer-component
    url='{{url('request')}}'
    csrf='{!! csrf_field('POST') !!}'
    :storage="{{Auth::user()->getStorage()}}"
    :storages="{{$storages}}"
    {{-- :person={{Auth::user()->person()}} --}}
    >
    </transfer-component>


@endsection
<script>


</script>
