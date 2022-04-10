@extends('frontend.layouts.master')
@section('content')


@stop
@push('styles')
<link rel="stylesheet" href="{{asset('custom-css/home.css')}}">
@endpush
@push('scripts')
<script type="text/javascript" src="{{asset('custom-js/home.js')}}"></script>
@endpush
