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

    :storage="{{Auth::user()->getStorage()}}"
    :request="{{$article_request}}"
    :histories="{{$histories}}"
    gerencia="{{Auth::user()->employee->management->name}}"
    :providers = "{{$providers}}"

    >
    </approve-request>

@endsection
<script>


</script>
