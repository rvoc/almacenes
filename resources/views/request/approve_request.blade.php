@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    <approve-request
    url='{{url('request')}}'
    csrf='{!! csrf_field('POST') !!}'
    :articles="{{$article_request_items}}"
    :storage="{{Auth::user()->getStorage()}}"
    :request="{{$article_request}}"
    :history="{{$histories}}"
    gerencia="{{Auth::user()->getGerencia()}}"
    :providers = "{{$providers}}"
    {{-- :person={{Auth::user()->person()}} --}}
    >
    </approve-request>

@endsection
<script>

   
</script>
