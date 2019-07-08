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
                        Rental Management
                    </div>

                    <div>
                        <div style="border: 1mm">
                            <form method="POST" action="{{ url('rental/add') }}">
                                {{ csrf_field() }}

                                <select name="kind_id" id="kind_id" data-dependent="book_id" class="dynamic">
                                    <option>Select Kind</option>
                                    @foreach ($kindlst as $kind)
                                        <option value="{{$kind->id}}">{{$kind->name}}</option>
                                    @endforeach
                                </select>

                                <select name="book_id" id="book_id">
                                    <option>Select Book</option>
                                </select>

                                <input type="text" name="student_name" placeholder="Student name">
                                <input type="text" name="student_class" placeholder="Class">
                                <input type="submit" value="Rental">
                            </form>

                            @if(count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <p><b style="color: red">{{ $error }}</b></p>
                                @endforeach
                            @endif

                            @if($message = Session::get('error'))
                                <p><b style="color: red">{{ $message }}</b></p>
                            @endif
                        </div>
            
                        <div>
                            <h1>Rental List</h1>
                            <div align="right" style="width: 100%; padding: 10px">
                                <a href="{{  url('/history') }}" style="border-radius: 25px; border: 1px solid black; padding: 5px; color: black">History</a>
                            </div>
                            <table border="1px solid", cellpadding="10", width="100%">
                                <thead>
                                    <th>No.</th>
                                    <th>Book Code</th>
                                    <th>Book Name</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                </thead>
                                @foreach ($data as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$item->book_code}}</td>
                                            <td>{{$item->book_name}}</td>
                                            <td>{{$item->student_name}}</td>
                                            <td>{{$item->student_class}}</td>
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
    $(document).ready(function(){
        $('.dynamic').change(function(){
            if($(this).val() != ''){

                var value = $(this).val();
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url: "{{ route('maincontroller.fetch') }}",
                    method: "POST",
                    data:{value:value, _token:_token},
                    success:function(result){
                        $('#book_id').html(result);
                    }
                });
            }
        });
    });
</script>