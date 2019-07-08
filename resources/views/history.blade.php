<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Geckoso's Library</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    <a href="{{  url('/') }}">Home</a>
                    <a href="{{  url('/bookkind') }}">Book Kind</a>
                    <a href="{{  url('/rental') }}">Rental</a>
                    <i>{{Auth::user()->email}}</i><a href="{{ url('/logout') }}">Logout</a>
                @else
                    <a href="{{  url('/login') }}">Login</a>
                @endauth
            </div>

            @auth
                <div class="content">
                    <div class="title m-b-md">
                        Rental History
                    </div>

                    <div>
                        <div>
                            <h1>Rental List</h1>
                            <div style="padding: 10px">
                                <form action="{{  url('/history/student') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name='stuname' placeholder="Student Name">
                                    <input type="text" name='stuclass' placeholder="Class">
                                    <input type="submit" value="Search">
                                </form>
                            </div>
                            <table border="1px solid", cellpadding="10", width="100%">
                                <thead>
                                    <th>No.</th>
                                    <th>Book Code</th>
                                    <th>Book Name</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Created At</th>
                                    <th>isRecieve</th>
                                </thead>
                                @foreach ($data as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$item->book_code}}</td>
                                            <td>{{$item->book_name}}</td>
                                            <td>{{$item->student_name}}</td>
                                            <td>{{$item->student_class}}</td>
                                            <td>{{$item->created_at}}</td>
                                            @if($item->isRecieve == true)
                                                <td><input disabled="true" type="checkbox" name="isRecieve" id="{{$item->id}}" checked ></td>
                                            @else
                                                <td><input type="checkbox" name="isRecieve" id="{{$item->id}}" onclick="save({{$item->id}})"></td>
                                            @endif
                                            
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="title m-b-md">
                    <a href="{{  url('/login') }}">Login</a>
                </div>
            @endauth
        </div>
    </body>
</html>

<script>
    function save(id){
        var checked = document.getElementById(id);
        var _token = $('input[name="_token"]').val();
        var isrecieve = 0;
        if(checked.checked){
            isrecieve = 1;
        }
        var r = confirm("Are you sure?");
        if(r){
            $.ajax({
                url: "{{ route('maincontroller.updaterental') }}",
                method: "POST",
                data:{checked: isrecieve, id: id, _token:_token},
                success:function(result){
                    if(result){
                        $("#"+id).attr( "disabled", "disabled" );
                        alert("Update success");
                    }else{
                        alert("Update fail");
                    }
                    
                }
            });
        }else{
            checked.checked = false;
        }
    }
</script>