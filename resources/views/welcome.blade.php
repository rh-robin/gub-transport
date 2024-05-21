<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Template</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
          font-family: Arial, sans-serif;
        }
        .calendar-container {
          width: 100%;
          margin: auto;
          border: 1px solid #ccc;
          border-radius: 5px;
          padding: 20px;
          position: relative;
        }
        .calendar {
          margin-bottom: 20px;
        }
        .month {
          text-align: center;
          font-size: 20px;
          margin-bottom: 20px;
        }
        .days {
          display: grid;
          grid-template-columns: repeat(7, 1fr);
          gap: 5px;
        }
        .day {
          text-align: center;
          padding: 5px;
          border-radius: 5px;
        }
        .day.prev, .day.next {
          color: #aaa;
        }
        .today {
          background-color: #007bff;
          color: #fff;
        }
        .btn {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          padding: 5px;
          cursor: pointer;
        }
        .prev-btn {
          left: 10px;
        }
        .next-btn {
          right: 10px;
        }
      </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" alt="Logo" width="120"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    
                    @if (Route::has('login'))
                    
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Student/Faculty</a></li>
                                <li><a class="dropdown-item" href="{{ route('driver.login') }}">Driver</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                    
                    @endif
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/01.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/02.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/03.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <!-- Add more carousel items as needed -->
        </div> {{-- end carousel inner --}}

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> {{-- end carouselExampleIndicators --}}

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
                <!-- Notice Box -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                        Notices
                        </div>
                        <div class="card-body">
                            <!-- List of notices goes here -->
                            <ul>
                                <li>Notice 1</li>
                                <li>Notice 2</li>
                                <li>Notice 3</li>
                                <!-- Add more notices as needed -->
                            </ul>
                        </div>
                    </div>
                </div> {{-- end col-lg-7 --}}
                <!-- Calendar -->
                <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                    Calendar
                    </div>
                    <div class="card-body">
                        <div class="calendar-container">
                            <button class="btn prev-btn"><i class="fas fa-chevron-left"></i></button>
                            <button class="btn next-btn"><i class="fas fa-chevron-right"></i></button>
                            <div class="calendar"></div>
                        </div>
                    </div>
                </div>
                </div> {{-- end col-lg-7 --}}
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Contact Info</h5>
                    <p>Address: Your Address</p>
                    <p>Phone: Your Phone Number</p>
                    <p>Email: Your Email Address</p>
                </div>
                <div class="col-md-6">
                    <h5>Follow Us</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        let currentYear;
        let currentMonth;
    
        function renderCalendar(year, month) {
        const calendar = document.querySelector('.calendar');
        currentYear = year;
        currentMonth = month;
    
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDayIndex = new Date(year, month, 1).getDay();
        const lastDayIndex = new Date(year, month, daysInMonth).getDay();
        const prevLastDay = new Date(year, month, 0).getDate();
        const nextDays = 7 - lastDayIndex - 1;
        
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];
        
        const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        
        let monthHtml = `<div class="month">${months[month]} ${year}</div>`;
        monthHtml += '<div class="days">';
        
        // Weekday labels
        for (let i = 0; i < weekdays.length; i++) {
            monthHtml += `<div class="day">${weekdays[i]}</div>`;
        }
        
        // Previous month's days
        for (let i = firstDayIndex - 1; i >= 0; i--) {
            monthHtml += `<div class="day prev">${prevLastDay - i}</div>`;
        }
        
        // Current month's days
        for (let i = 1; i <= daysInMonth; i++) {
            if (i === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
            monthHtml += `<div class="day today">${i}</div>`;
            } else {
            monthHtml += `<div class="day">${i}</div>`;
            }
        }
        
        // Next month's days
        for (let i = 1; i <= nextDays; i++) {
            monthHtml += `<div class="day next">${i}</div>`;
        }
        
        monthHtml += '</div>';
        
        calendar.innerHTML = monthHtml;
        }
    
        document.querySelector('.prev-btn').addEventListener('click', () => {
        if (currentMonth === 0) {
            currentYear--;
            currentMonth = 11;
        } else {
            currentMonth--;
        }
        renderCalendar(currentYear, currentMonth);
        });
    
        document.querySelector('.next-btn').addEventListener('click', () => {
        if (currentMonth === 11) {
            currentYear++;
            currentMonth = 0;
        } else {
            currentMonth++;
        }
        renderCalendar(currentYear, currentMonth);
        });
    
        // Initial rendering
        const now = new Date();
        renderCalendar(now.getFullYear(), now.getMonth());
    </script>

</body>
</html>



                        {{-- @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif --}}