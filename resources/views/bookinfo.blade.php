@extends('master')

@section('title')
    Book Information
@endsection

@section('content')
    <div class='col-xl-12'>
        <form id="book" method="POST" action="{{url('/book/update')}}">
            {{ csrf_field() }}
            <input type="hidden" value="{{$book->id}}" name="book_id">
            <table style="width: 100%">

                <tr >
                    <td class="book_info"><b>Book Name: </b></td>
                    <td class="book_info"><input type="text" name="book_name" value="{{$book->name}}"> </td>
                </tr>
                <tr>
                    <td class="book_info"><b>Kind Name: </b></td>
                    <td class="book_info">
                        <select name="kind_id" class="kind-selection col-sm-12">
                            <option value="{{ $book->kind_id }}">{{ $book->book_kind->name }}</option>
                            @foreach ($kind as $item)
                                @if ($item->id != $book->kind_id)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="book_info"><b>Kind Code: </b> </td>
                    <td class="book_info">{{$book->book_kind->kind_code}} </td>
                </tr>
                <tr>
                    <td class="book_info"><b>Amount: </b> </td>
                    <td class="book_info"><input type="text" name="amount" value="{{$book->amount}}"> </td>
                </tr>
                <tr>
                    <td class="book_info"><b>Book Code: </b> </td>
                    <td class="book_info">{{$book->code}} </td>
                </tr>
                <tr>
                    <td class="book_info"><b>Status: </b> </td>
                    <td class="book_info">
                        <input type="checkbox" data-toggle="toggle" data-size="small" 
                        data-onstyle="success" data-offstyle="danger"
                        @if ($book->isActive)
                            checked
                        @endif
                        id="check_status">
                        <input type="hidden" name="book_status" id="status">
                    </td>
                </tr>
            </table>
            <div class="col-xl-12 text-center">
                <hr>
                <input type="submit" class="btn btn-primary" value="Update" onclick="checkstatus()">
                <a href=" {{url('/book/list')}} " class="btn btn-primary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        $('.kind-selection').select2();
        function checkstatus(){        
            if( $("#check_status").prop('checked') ){
                $("#status").val(1);
            }else{
                $("#status").val(0);
            }
        }
    </script>

    <style>
        .book_info{ padding: 10px;}
    </style>
@endsection