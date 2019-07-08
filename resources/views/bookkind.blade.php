<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    <a href="{{  url('/book') }}">Book</a>
                    <a href="{{  url('/rental') }}">Rental</a>
                    <i>{{Auth::user()->email}}</i><a href="{{ url('/logout') }}">Logout</a>
                @else
                    <a href="{{  url('/login') }}">Login</a>
                @endauth
            </div>

            <div class="content">
                <div class="title m-b-md">
                    Book Kinds Management
                </div>

                @auth
                    <div>
                        <div style="border: 1mm">
                            <form method="POST" action="{{ url('bookkind/add') }}">
                                {{ csrf_field() }}
                                <input type="text" name="name" placeholder="name" width="100%">
                                <input type="submit" value="Add">
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
                            <h1>Book kind list</h1>
                            <table border="1", cellpadding="10", width="100%">
                                <thead>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                </thead>
                                @foreach ($data as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->code}}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </body>
</html>