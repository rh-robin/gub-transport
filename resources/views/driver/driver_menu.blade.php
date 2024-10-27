@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<div class="image py-3">
    <img src="{{ !empty($driver->image) ? asset($driver->image) : url('upload/noimage.jpg') }}" alt="Logo" width="120">
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'driver.dashboard') ? 'active' : '' }}"><a href="{{ route('driver.dashboard') }}" class="{{ ($route === 'driver.dashboard') ? 'text-light' : '' }} d-block">Dashboard</a></li>
    
    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'driver.profile') ? 'active' : '' }}"><a href="{{ route('driver.profile') }}" class="{{ ($route === 'driver.profile') ? 'text-light' : '' }} d-block">Profile</a></li>
    <li class="list-group-item list-group-item-action dashboard-link">
        <a class="d-block" href="{{ route('driver.logout') }}">
            Logout
        </a>
    </li>
</ul>