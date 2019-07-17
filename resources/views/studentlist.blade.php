@extends('master')

@section('title')
    Students Table
@endsection

@section('content')
<form method="POST" action="{{ url('/student/add') }}">
    {{ csrf_field() }}
    <div class="row form-group">
        <div class="col-xl-12">
            <div class="mb-2">
            <h6>Get Class: </h6>
            <select name="class_id" class="classes-list" style="width: 100%">
                <option value="">Select class</option>
                @foreach ($class as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <h6>Student Name: </h6>
            <input type="text" class="form-control small" placeholder="Student name" name="name">
            </div>
            <div class="text-center">
                <input type="submit" value="Add this Student" class="btn btn-primary">
            </div>
        </div>
        </div>
        <hr>
    </div>
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
        @endforeach
    </ul>
    
</form>

<table width="100%">
    <thead>
        <th width="20%">Full name</th>
        <th width="20%">Class</th>
        <th width="20%">Action</th>
    </thead>
    <tbody>
        @foreach ($data as $student)
            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->class->name}}</td>
                <td>
                    <a href="{{ url('/student/profile?id='.$student->id)}}" ><i class="fas fa-eye"></i></a> |
                    <a href="{{ url('/student/delete?id='.$student->id)}}" data-toggle="modal" data-target="#confirmModal"
                         class="confirm-action-btn"><i class="fas fa-trash" style="color: red"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $data->links() }}

<script>
    $('.classes-list').select2();
</script>
@endsection
