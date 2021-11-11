@extends('base')

@section('content')
<h1>{{ $enterprise }}</h1>
@if(old('id') != '')
    <div class="alert alert-danger" role="alert">
        Error. Mira el ID.
    </div>
@endif
<form action="{{ url('resource') }}" method="post">
    @csrf
    <input value="{{ old('id') }}" type="number" name="id" placeholder="Introduce Id" min="1" step="1" disabled hidden />
    <input value="{{ old('name') }}" type="text" name="name" placeholder="Introduce nombre" min-length="5" max-length="30" required />
    <input value="{{ old('price') }}" type="number" name="price" placeholder="Introduce precio" min="1" step="0.01" required />
    <input type="submit" value="Create"/>
</form>

@endsection