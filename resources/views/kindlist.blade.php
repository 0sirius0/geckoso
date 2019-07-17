@extends('master')

@section('title')
    Book Kinds Table
@endsection

@section('content')
<form method="POST" action="{{ url('/kind/add') }}">
    {{ csrf_field() }}
    <h4>Add Kind</h4>
    <div class="input-group mb-2">
        <input type="text" class="form-control small" placeholder="Kind name" name="name">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
</form>
<hr>
<table width="100%">
    <thead>
        <th width="20%">Name</th>
        <th width="20%">Code</th>
        <th width="20%">Status</th>
        <th width="20%">Action</th>
    </thead>
    <tbody>
        @foreach ($data as $kind)
            <tr>
                <td>{{$kind->name}}</td>
                <td>{{$kind->kind_code}}</td>
                <td>
                    @if ($kind->isActive)
                        <i class="fas fa-check" style="color: green"></i>
                    @else
                        <i class="fas fa-window-close" style="color: red"></i>
                    @endif
                    </td>
                <td>  
                    <a href="{{ url('/book/listbykind?id='.$kind->id)}}" ><i class="fas fa-eye"></i></a> |
                    <a href="{{ url('/kind/delete?kind_id='.$kind->id)}}" data-toggle="modal" data-target="#confirmModal"
                        class="confirm-action-btn"><i class="fas fa-trash" style="color: red"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $data->links() }}
@endsection