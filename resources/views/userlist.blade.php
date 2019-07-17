@extends('master')

@section('title')
    User table
@endsection
    

@section('content')

    <table width="100%">
        <thead>
            <th width="20%">Full name</th>
            <th width="20%">Email</th>
            <th width="20%">Level</th>
            @if (Auth::User()->level->priority == 1)
                <th width="20%">Status</th>
            @endif
            <th width="20%">Action</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->priority}}</td>
                    @if (Auth::User()->level->priority == 1)
                        <td width="20%">
                            @if ($item->user_status)
                                <i class="fas fa-check" style="color: green"></i>
                            @else
                                <i class="fas fa-window-close" style="color: red"></i>
                            @endif
                        </td>
                    @endif
                    <td>
                        <a href="{{ url('/employee/profile?id='.$item->id)}}" ><i class="fas fa-eye"></i></a> |
                        <a href="{{ url('/employee/delete?user_id='.$item->id)}}" data-toggle="modal" data-target="#confirmModal"
                            class="confirm-action-btn"><i class="fas fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $data->links() }}
    </table>
    

@endsection