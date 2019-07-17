@extends('master')

@section('title')
    Histories
@endsection

@section('content')
<div class="row form-group">
    <div class="col-xl-12 text-right">
        @if ($viewall)
        <a href="{{ url('/rental/historydisasble') }}">View rental not take back !!!</a>
        @else
        <a href="{{ url('/rental/history') }}">View all</a>
        @endif
    </div>
</div>
    <table class="col-xl-12">
        <thead>
            <th>Student</th>
            <th>Book</th>
            <th>Create Date</th>
            <th>Recieve Date</th>
            <th>isRecieve</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
            <tr>
                <td>{{$rental->student->name}}</td>
                <td>{{$rental->book->name}}</td>
                <td>{{$rental->created_at}}</td>
                <td>
                    @if ($rental->created_at == $rental->updated_at)
                        Not Yet
                    @else
                        {{$rental->updated_at}}
                    @endif
                </td>
                <td>
                    @if ($rental->isRecieve)
                        <i class="fas fa-check" style="color: green"></i>
                    @else
                        <i class="fas fa-window-close" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if (!$rental->isRecieve)
                    <a href="{{ url('/rental/checkrecieve?rental_id='.$rental->id) }}" class="btn btn-primary">Recieved</a>
                    @endif
                </td>
            </tr>    
            @endforeach
        </tbody>

        {{ $rentals->links() }}
    </table>

    <script>

    </script>
@endsection