
@extends('layouts.app-master')
@section('content')
    @auth()      
      @if (Auth::check())
      <p>Bienvenido, Usuario {{ Auth::user()->usuario }}</p>
      @else
      <p>No estás autenticado.</p>
      @endif
    @endauth
    @guest()
      @include('user.login_emprendedor_digital')
    @endguest
    
@endsection