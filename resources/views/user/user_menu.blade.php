@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<div class="image py-3">
    <img src="{{ !empty($user->image) ? asset($user->image) : url('upload/noimage.jpg') }}" alt="Logo" width="120">
</div>
<ul class="list-group list-group-flush">

    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}" class="{{ ($route === 'dashboard') ? 'text-light' : '' }} d-block">Dashboard</a></li>

    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'user.preselection') ? 'active' : '' }}"><a href="{{ route('user.preselection') }}" class="{{ ($route === 'user.preselection') ? 'text-light' : '' }} d-block">Pre-selection</a></li>

    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'user.findVehicle') ? 'active' : '' }}"><a href="{{ route('user.findVehicle') }}" class="{{ ($route === 'user.findVehicle') ? 'text-light' : '' }} d-block">Find Vehicle</a></li>
    
    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'user.profile.view') ? 'active' : '' }}"><a href="{{ route('user.profile.view') }}" class="{{ ($route === 'user.profile.view') ? 'text-light' : '' }} d-block">Profile</a></li>

    <li class="list-group-item list-group-item-action dashboard-link {{ ($route === 'profile.edit') ? 'active' : '' }}"><a href="{{ route('profile.edit') }}" class="{{ ($route === 'profile.edit') ? 'text-light' : '' }} d-block">Change Password</a></li>
    <li class="list-group-item list-group-item-action dashboard-link">
        <a class="" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>