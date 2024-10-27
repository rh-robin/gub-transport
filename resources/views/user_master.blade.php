<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
        integrity="sha384-cmCGPRstySLBdjs6Xm7OQDJbOIuBHCW5PYKhehsADLJ3h8tHnTvPzamxLFsN9b4C" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- ============= toastr ============ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <style>
        *{
            box-sizing: border-box;
        }
        
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
                            <img src="{{ !empty($user->image) ? asset($user->image) : url('upload/noimage.jpg') }}" alt="Logo" width="30px" style="border-radius: 50%">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            
                        </ul>
                    </li>
                    
                </ul>
              </div>
            </div>
        </nav>
    </header>



<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('user.user_menu')
        </div> {{-- end col-md-3 --}}
        <div class="col-md-9">
            <!-- Main Content -->
            <div class="container-fluid mt-4">
                @yield('content')
                <!-- Add your content here -->
            </div>
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


    {{-- scripts for toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type) {
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            toast[0].style.color = "red";
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }}");
            break;
        }
        @endif
    </script>

    <!-- ============== Select2 JS ================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#selectDay').select2({
                placeholder: "Select Day",
                allowClear: true
            });

            $('#selectPickup').select2({
                placeholder: "Select Pickup Area",
                allowClear: true
            });
        });
    </script>


    {{-- ======= ajax ============ --}}
    <script>
    $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    })

    
    
</body>

</html>
