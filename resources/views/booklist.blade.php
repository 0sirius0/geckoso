@extends('master')

@section('title')
    Books Table
@endsection

@section('content')
<form method="POST" action="{{ url('/book/add') }}">
    {{ csrf_field() }}
    <h4>Add Book</h4>
    <div class="form-group">
        <select name="kind_id" class="kind-selection col-sm-12">
            <option>Select Kind</option>
            @foreach ($kind as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="text" class="form-control small" placeholder="Add Book Name" name="book_name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control small" placeholder="Amount" name="amount">
    </div>
    <div class="col-xl-12">
        <div class="col-sm-12 text-center">
            <input type="submit" value="Save" class="btn btn-primary">
            <input type="reset" value="Reset" class="btn btn-primary">
        </div>
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
        <th>Name</th>
        <th>Kind Code</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Code</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($data as $book)
            <tr>
                <td>{{$book->name}}</td>
                <td>{{$book->book_kind->kind_code}}</td>
                <td>{{$book->amount}}</td>
                <td>
                    @if ($book->isActive)
                        <i class="fas fa-check" style="color: green"></i>
                    @else
                        <i class="fas fa-window-close" style="color: red"></i>
                    @endif
                </td>
                <td>{{$book->code}}</td>
                <td>
                    <a href="{{ url('/book/info?book_id='.$book->id)}}" ><i class="fas fa-eye"></i></a> |
                    <a href="{{ url('/book/delete?book_id='.$book->id)}}" data-toggle="modal" data-target="#confirmModal"
                        class="confirm-action-btn"><i class="fas fa-trash" style="color: red"></i></a>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $data->links() }}

<script>
    $(document).ready(function(){
        $('.kind-selection').select2();
    });
</script>
@endsection