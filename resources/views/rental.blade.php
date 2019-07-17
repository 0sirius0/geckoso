@extends('master')

@section('title')
    Rental
@endsection

@section('content')
    <div class="row form-group">
        <form method="POST" action=" {{ url('/rental/add') }}" class="col-sm-12">
            {{ csrf_field() }}
            <div class="row form-group">
                <div class="col-sm-6">
                    <h5>Book Kind</h5>
                    <select data-placeholder="Select book kind" name="kind-id" class="kind-selection col-sm-12" tabindex="5">
                        <option value="">Select book kind</option>
                        @foreach ($kinds as $kind)
                        <option value="{{ $kind->id }}">{{ $kind->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-6">
                    <h5>Book</h5>
                    <select data-placeholder="Select book" name="book-id" class="book-selection col-sm-12" tabindex="5" disabled>
                        <option value="">Select book</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-6">
                    <h5>Class</h5>
                    <select data-placeholder="Select Class" name="class-id" class="class-selection col-sm-12" tabindex="5">
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <h5>Student</h5>
                    <select data-placeholder="Select Student" name="student-id" class="student-selection col-sm-12" tabindex="5" disabled>
                        <option value="">Select Student</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-sm-12 text-center">
                <input type="submit" value="Send" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-primary">
            </div>
        </form>
    </div>
    

<script type="text/javascript">
    $(document).ready(function() {
        $('.kind-selection').select2();
        $('.book-selection').select2();
        $('.class-selection').select2();
        $('.student-selection').select2();

        $( ".kind-selection" ).change(function() {
            var urlbooklst = "{{url('/book/autocomplete?kind_id=')}}" + $('.kind-selection').val();
            
            $.get( urlbooklst, function( data ) {
                if(data.length > 0){
                    $( ".book-selection" ).prop("disabled", false);
                    $( ".book-selection" ).html( "<option value=''>Select Book</option>");
                    $.each(data, function (index, value) {
                        $( ".book-selection" ).append( "<option value="+value.id+">"+value.name+"</option>");
                    });
                }else{
                    $( ".book-selection" ).prop("disabled", true);
                    $( ".book-selection" ).html( "<option value=''>Select Book</option>");
                }
            });
        });

        $( ".class-selection" ).change(function() {
            var urlstulst = "{{url('/student/autocomplete?class_id=')}}" + $('.class-selection').val();
            
            $.get( urlstulst, function( data ) {
                if(data.length > 0){
                    $( ".student-selection" ).prop("disabled", false);
                    $( ".student-selection" ).html( "<option value=''>Select Student</option>");
                    $.each(data, function (index, value) {
                        $( ".student-selection" ).append( "<option value="+value.id+">"+value.name+"</option>");
                    });
                }else{
                    $( ".student-selection" ).prop("disabled", true);
                    $( ".student-selection" ).html( "<option value=''>Select Student</option>");
                }
            });
        });
    });
</script>  

@endsection



