@extends('master')

@section('title')
Class Table
@endsection

@section('content')
<table width="50%">
    <tr>
        <form method="POST" action="{{ url('/class/add') }}">
            {{ csrf_field() }}
            <td><input type="text" class="form-control small" placeholder="Add more Level" name="name_add"></td>
            <td><input type="submit" value="Save" class="btn btn-primary"></td>
        </form>
    </tr>
</table>
<ul>
    @foreach ($errors->all() as $error)
        <li style="color: red">{{ $error }}</li>
    @endforeach
</ul>
<hr>
<table width="100%">
    <thead>
        <th width="10%">ID</th>
        <th width="50%">Name</th>
        <th width="20%">Status</th>
        <th width="20%">Action</th>
    </thead>
    <tbody>
        @foreach ($stuclass as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td style="padding:10px">
                    <input type="text" class="form-control small"  name="name_update" value="{{$item->name}}" readonly>
                </td>
                <td>
                    @if ($item->isActive)
                        <i class="fas fa-check" style="color: green"></i>
                    @else
                        <i class="fas fa-window-close" style="color: red"></i>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/class/update?name_update='.$item->name.'&&isActive=0&&id='.$item->id)}}" data-toggle="modal" data-target="#confirmModal"
                        class="confirm-action-btn"><i class="fas fa-trash" style="color: red"></i></a>
                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>
@endsection