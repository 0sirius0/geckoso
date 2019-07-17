@extends('master')

@section('title')
    User Profile
@endsection

@section('content')

<form method="POST" action="{{ url('/employee/update') }}" id="formedit">

    {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{{ $data->id }}">
    <div class="row form-group">
        <div class="col-xl-3">Full name</div>
        <div class="col-xl-9">
            <input type="text" class="form-control form-control-user" 
            name="name" value="{{$data->name}}" readonly>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-xl-3">Email</div>
        <div class="col-xl-9">
            <input type="email" class="form-control form-control-user" 
            name="email" value="{{$data->email}}" id="email" readonly>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-xl-3">Password</div>
        <div class="col-xl-9">
            <input type="password" class="form-control form-control-user" 
            name="password" value="{{$data->password}}" id="password" readonly>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-xl-3">Rank</div>
        <div class="col-xl-9">
            {{$data->level->name}}
            <input type="hidden" value="{{ $data->level_id }}" name="level_id">
            
        </div>
    </div>

    @if($isdelete)
    <div class="row form-group">
        <div class="col-xl-3">isActive</div>
        <div class="col-xl-9">
            <input type="checkbox" data-toggle="toggle" data-size="small" 
            data-onstyle="success" data-offstyle="danger"
            @if ($data->user_status)
                checked
            @endif
            id="check_status" onchange="checkstatus()" disabled>
        </div>
    </div>
    @endif
    <input type="hidden" value="{{ $data->user_status }}" name="user_status" id="user_status">
        
    <div class="row form-group">
        <div class="col-xl-12">
            <a href="#" id="editbtn" onclick="clickme()" 
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit"></i> 
                <span>Edit profile</span>
            </a>

            <button type="submit" id="submitbtn" form="formedit" style="visibility:hidden"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-check"></i> 
                <span>Save</span>
            </button>

            <a href="#" id="cancelbtn" onclick="cancelcliked()" style="visibility:hidden"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-window-close "></i> 
                <span>Cancel</span>
            </a>
        </div>
    </div>
</form>

@endsection

<script>
    function clickme(){
        $('#email').prop("readonly", false);
        $('#password').prop("readonly", false);
        $('#check_status').prop("disabled", false);

        $('#editbtn').css("visibility", 'hidden');
        $('#submitbtn').css("visibility", 'visible');
        $('#cancelbtn').css("visibility", 'visible');
    }
    
    function cancelcliked(){
        location.reload();
    }

    function checkstatus(){        
        if( $("#check_status").prop('checked') ){
            $("#user_status").val(1);
        }else{
            $("#user_status").val(0);
        }
    }
</script>
