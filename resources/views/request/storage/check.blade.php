@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    <check-request-store
    url='{{url('transfer_request_store')}}'
    csrf='{!! csrf_field('POST') !!}'
    :articles="{{$article_request_items}}"
    :storage="{{Auth::user()->getStorage()}}"
    :request="{{$article_request}}"
    gerencia="{{Auth::user()->getGerencia()}}"
    :providers = "{{$providers}}"
    >
    </check-request-store>


@endsection
<script>


</script>
