
@extends('layouts.app-master')
@section('content') 
@if (@auth())             
      @if (Auth::guard('client')->check())
      <p>Bienvenido, Cliente {{ Auth::guard('client')->user()->usuario }}</p> 
      @else
        @include('client.login_client')
      @endif    
@endif
@endsection