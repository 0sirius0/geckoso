@extends('master')

@section('title')
Level Table
@endsection

@section('content')
<table width="50%">
    <tr>
        <form method="POST" action="{{ url('/level/add')}}">
            {{ csrf_field() }}
            <td><input type="text" class="form-control small" placeholder="Add more Level" name="name_add"></td>
            <td><input type="submit" value="Save" class="btn btn-primary"></td>
        </form>
    </tr>
</table>
<hr>
<table width="100%">
    <thead>
        <th width="20%">Rank</th>
        <th width="60%">Name</th>
        <th width="20%">Action</th>
    </thead>
    <tbody>
        @foreach ($level as $item)
            <tr>
                <td>{{$item->priority}}</td>
                <td style="padding:10px">
                    <input type="text" class="form-control small"  name="name" value="{{$item->name}}" readonly>
                </td>
                <td>
                    <a href="{{ url('/level/up?id='.$item->id)}}" ><i class="fas fa-arrow-up"></i></a>
                    <a href="{{ url('/level/down?id='.$item->id)}}" ><i class="fas fa-arrow-down"></i></a>
                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>
@endsection