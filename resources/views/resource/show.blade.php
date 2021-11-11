@extends('base')

@section('content')
<h1>{{ $enterprise }}</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col"># id</th>
            <th scope="col">name</th>
            <th scope="col">price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{$resource['id']}}
            </td>
            <td>
                {{$resource['name']}}
            </td>
            <td>
                {{$resource['price']}}
            </td>
            <td>
                <a href="{{url('resource')}}">volver</a>
            </td>
        </tr>
@endsection