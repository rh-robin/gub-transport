@extends('user_master')
@section('content')
    <?php
    $routes = App\Models\Route::with(['vehicleInRoutes.vehicle', 'mainDeparture'])->get();
    foreach ($routes as $route) {
        $route->pickupTime = $route->vehicleInRoutes->sortBy('pickup_time')->first();
    }
    ?>
    <h2>Welcome To Your Gub Transport Dashboard</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="20%" style="padding: 5px">Route name</th>
                    <th width="20%" style="padding: 5px">Pickup</th>
                    <th width="20%" style="padding: 5px">Pickup Time</th>
                    <th width="25%" style="padding: 5px">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($routes as $route)
            <tr>
                <td width="20%" style="padding: 5px">{{ $route->route_name }}</td>
                <td width="20%" style="padding: 5px">{{ $route->mainDeparture->area_name }}</td>
                <td width="20%" style="padding: 5px">{{ $route->pickupTime->pickup_time }}</td>
                <td width="25%" style="padding: 5px" class="text-center">
                    <a href="{{ route('user.route.view', $route->id) }}" class="btn btn-sm mx-1 btn-info mb-1" title="Edit Data"><i class="fa-solid fa-eye"></i></a>
                </td>
            </tr>
            @empty
            @endforelse

            </tbody>
        </table>
    </div>
@endsection