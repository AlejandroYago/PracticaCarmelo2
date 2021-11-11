@extends('base')

@section('content')
<h1>Edita al gusto</h1>
<form action="{{ url('resource/' . $resource['id']) }}" method="post">
    @csrf
    @method('put')
    <input value="{{ old('id', $resource['id']) }}" type="number" name="id" placeholder="#id positive integer" min="1" step="1" required hidden />
    <input value="{{ old('name', $resource['name']) }}" type="text" name="name" placeholder="Name of the resource" min-length="5" max-length="30" required />
    <input value="{{ old('price', $resource['price']) }}" type="number" name="price" placeholder="Introduce precio" min="0" step="0.01" required />
    <input type="submit" value="Edit"/>
</form>

@endsection