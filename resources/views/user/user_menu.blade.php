<div class="image py-3">
    <img src="{{ asset('images/avatar.png') }}" alt="Logo" width="120">
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-action dashboard-link"><a >Dashboard</a></li>
    <li class="list-group-item list-group-item-action dashboard-link"><a >View All Slots</a></li>
    <li class="list-group-item list-group-item-action dashboard-link"><a >Find Slot</a></li>
    <li class="list-group-item list-group-item-action dashboard-link"><a >Pre-selection</a></li>
    <li class="list-group-item list-group-item-action dashboard-link"><a href="{{ route('profile.edit') }}">Profile</a></li>
    <li class="list-group-item list-group-item-action dashboard-link">
        <a class="" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>