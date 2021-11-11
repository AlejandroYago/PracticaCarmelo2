@php
    use App\Http\Controllers\IndexController;
@endphp

@extends('base')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Aplicacion Practica jueves</h1>
        <p class="col-md-8 fs-4">Vamos a crear recursos con Id, nombre y precio
        
        <!--<a href="{{-- url('about') --}}">about enlace 1</a>
        <a href="{{-- route('acerca') --}}">about enlace 2</a>
        <a href="{{-- action([App\Http\Controllers\IndexController::class, 'about']) --}}">about enlace 3</a>
        <a href="{{-- action([IndexController::class, 'about']) --}}">about enlace 3</a>-->
        
        .</p>
        <p class="col-md-8 fs-4">
          <a href="{{ url('resource') }}">Link hacia recursos</a>.
        </p>
      </div>
    </div>
@endsection