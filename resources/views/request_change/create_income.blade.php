@extends('layouts.app')
@section('title')
    {{-- Proveedores --}}
@endsection
@section('breadcrums')
    {{-- {{ Breadcrumbs::render('action_medium_term') }} --}}
@endsection
@section('content')

    {{-- aqui los modals --}}
    <change-income
        url='{{url('request_change')}}'
        csrf='{!! csrf_field('POST') !!}'
        :income="{{$article_income}}"
        :articles= "{{$articles}}"
    >
    </change-income>

@endsection
