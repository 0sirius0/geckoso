@extends('master')

@section('title')
    Register
@endsection
    
@section('content')
        
    <ul>
        @if($message = Session::get('error'))
        <li style="color: red">{{ $message }}</li>
        @endif
    </ul>
    
    @if(count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

 
    <form method="POST" action="{{ url('/employee/add') }} ">
        {{ csrf_field() }}
        <div class="row form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control form-control-user" placeholder="Full name" name="name">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-12">
                <input type="email" class="form-control form-control-user" placeholder="Email" name="email">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-12">
                <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-12">
                <input type="password" class="form-control form-control-user" placeholder="Confirm password" name="password_confirmation">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-12">
                <select class="form-control form-control-user" name="level_id">
                    <option>Select an option</option>
                    @foreach ($data as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
            </div>
        </div>                                
    </form>
                        

@endsection