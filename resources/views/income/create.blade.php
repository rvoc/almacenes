@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    {{-- aqui los modals --}}
<income-component url='{{url('income')}}' csrf='{!! csrf_field('POST') !!}' :articles="{{$articles}}" :providers="{{$providers}}" :storage="{{Auth::user()->getStorage()}}" ></income-component>


@endsection
