<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        
        .image img{
            width: 200px;
            border-radius: 50%;
            border: 2px solid #000;
        }

        .dashboard-link {
            color: #333; /* Text color */
            transition: color 0.3s; /* Smooth color transition on hover */
            cursor: pointer;
        }
        .dashboard-link a{
            text-decoration: none;
            color: #333; /* Text color */
        }

        .dashboard-link:hover a {
            color: #007bff; /* Change text color on hover */
            
        }

        
        .footer {
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-light text-white py-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
              <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" alt="Logo" width="120"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ !empty($driver->image) ? asset($driver->image) : url('upload/noimage.jpg') }}" alt="Logo" width="30px" style="border-radius: 50%">
                            {{ $driver->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('driver.profile') }}">Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('driver.logout') }}">
                                    Logout
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    
                </ul>
              </div>
            </div>
        </nav>
    </header>



<div class="container">
    <div class="row py-4">
        <div class="col-md-3">
            @include('driver.driver_menu')
        </div> {{-- end col-md-3 --}}
        <div class="col-md-9">
            <!-- Main Content -->
            
            @yield('content')
            <!-- Add your content here -->
            
        </div>
    </div>
</div>

    

    

    

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <span>&copy; 2024 Your Company</span>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    
    
</body>

</html>
