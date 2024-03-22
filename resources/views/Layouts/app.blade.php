<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f8f8;
        }

        .card {
            width: 60%;
            margin: auto;
            margin-top: 15px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .bodyMain { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: sans-serif; 
            line-height: 1.5; 
            min-height: 100vh; 
            background: #f3f3f3; 
            flex-direction: column; 
            margin: 0; 
        } 
        
        .main { 
            background-color: #fff; 
            border-radius: 15px; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); 
            padding: 20px; 
            transition: transform 0.2s; 
            width: 500px; 
        }

        .main {
            h3{
                color: #4CAF50;
                text-align: center; 
            }
            h6 {
                text-align: center; 
            }
        }

        img {
            width: 100%;
            height: 250px;
            object-fit: contain;
        }

        input[type=checkbox] {
            width: 1rem;
            height: 1rem;
        }
    </style>
</head>
<body class="bodyMain">
    {{-- <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">Laravel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
       
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endguest
                </ul>
      
            </div>
        </div>
    </nav>
      
    <div class="container mt-5">
        @yield('content')
    </div> --}}

</body>
</html>