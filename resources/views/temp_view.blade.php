@extends('layouts.main_app')

@section('pageTitle')
{{ __('home.home') }}
@endsection

 
@section('content')
<x-post :post=$post />
@endsection