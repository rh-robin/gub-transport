@extends('user_master')
@section('content')
<h2>Route: {{ $route->route_name }}</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th width="20%" style="padding: 5px">Vehicle</th>
                <th width="20%" style="padding: 5px">Pickup</th>
                <th width="20%" style="padding: 5px">Pickup Time</th>
                <th width="20%" style="padding: 5px">Days</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($routeVehicles as $routeVehicle)
            <tr>
                <td width="20%" style="padding: 5px">{{ $routeVehicle->vehicle->vehicle_number }}</td>
                <td width="20%" style="padding: 5px">{{ $routeVehicle->pickupArea->area_name }}({{ $routeVehicle->pickupArea->pickup_point }})</td>
                <td width="20%" style="padding: 5px">{{ $routeVehicle->pickup_time }}</td>
                <td width="20%" style="padding: 5px">{{ $routeVehicle->days }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection