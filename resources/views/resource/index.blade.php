@extends('base')

@section('content')
<!--Forma1-->
<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Confirm delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Delete resource"/>
        </form>
      </div>
    </div>
  </div>
</div>
<!--findeforma1-->
<h1>Aqui muestro los recursos</h1>
@isset($message)
    <div class="alert alert-{{ $type ??'success'}}" role="alert">
        {{ $message }}
    </div>
@endisset
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col"># id</th>
            <th scope="col">name</th>
            <th scope="col">price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resources as $resource)
            <tr>
                <td>
                    {{ $resource['id'] }}
                </td>
                <td>
                    {{ $resource['name'] }}
                </td>
                <td>
                    {{ $resource['price'] }}
                </td>
                <td>
                    <a href="{{url('resource/' .$resource['id'])}}">show</a>
                </td>
                <td>
                    <a href="{{ action([App\Http\Controllers\ResourceController::class, 'edit'], $resource['id']) }}">edit</a>
                </td>
                   <td>
                    <!-- nuevo 2 -->
                    <form class="deleteForm" action="{{ url('resource/' . $resource['id']) }}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" value="delete"/>
                    </form>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('resource/create') }}" class="btn btn-primary btn-lg" type="button">Añade recursos</a>
<a href="{{ url('/')}}" class="btn btn-primary btn-lg" type="button">Vuelve al Home</a>

<!--Nuevo3-->
<form id="deleteResourceForm" action="" method="post">
    @method('delete')
    @csrf
</form>

<!-- fin nuevo 3 -->
@endsection

@section('js')
<!-- nuevo 4 -->
<script src="{{ url('assets/js/delete.js') }}"></script>
<!-- nuevo 4 -->
@endsection