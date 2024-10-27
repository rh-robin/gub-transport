@extends('driver.driver_master')
@section('content')
    
    <h2>Welcome To Driver Dashboard</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="20%" style="padding: 5px">Route name</th>
                    <th width="20%" style="padding: 5px">Pickup</th>
                    <th width="20%" style="padding: 5px">Pickup Time</th>
                    <th width="20%" style="padding: 5px">Vehicle</th>
                    <th width="20%" style="padding: 5px">Days</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($routes as $route)
            <tr>
                
                <td width="20%" style="padding: 5px">{{ $route->route_name }}</td>
                <td width="20%" style="padding: 5px">
                    @forelse ($routeVehicles as $routeVehicle)
                    {{ $routeVehicle->route_id == $route->id ?$routeVehicle->pickupArea->area_name."(".$routeVehicle->pickupArea->pickup_point.")" : "" }}
                    @endforeach
                </td>
                <td width="20%" style="padding: 5px">
                    @forelse ($routeVehicles as $routeVehicle)
                    {{ $routeVehicle->route_id == $route->id ? $routeVehicle->pickup_time : "" }}
                    @endforeach
                </td>
                <td width="20%" style="padding: 5px">
                    @forelse ($routeVehicles as $routeVehicle)
                    {{$routeVehicle->route_id == $route->id ? $routeVehicle->vehicle->vehicle_number : ""}}
                    @endforeach
                </td>
                <td width="20%" style="padding: 5px">
                    @forelse ($routeVehicles as $routeVehicle)
                    {{$routeVehicle->route_id == $route->id ? $routeVehicle->days : ""}}
                    @endforeach
                </td>
            </tr>
            @empty
            @endforelse

            </tbody>
        </table>
    </div>
@endsection