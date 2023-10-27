@extends('layouts.app-master')
@section('content')
@guest()
  <p>SOLO PERSONAL AUTORIZADO!!!</p>
@endguest
@auth()
@if (Auth::user()->id_rango === 1)
 <div class="container w-50 form-edit">
    <div class="row">
        <div class="col conten-login">  
            <p>Cargar Provincias</p>        
            <form method="post" action="{{ route('import.excel') }}" enctype="multipart/form-data">
             @csrf             
             <input type="file" name="file">
             <button type="submit">Subir archivo</button>
            </form>             
        </div>
    </div>
 </div> 
@endif        
@endauth    
@endsection
