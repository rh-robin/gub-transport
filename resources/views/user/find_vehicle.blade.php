@extends('user_master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-center">Find Vehicle</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.findVehicle.submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gub_id" class="form-label">Select Pickup Point <strong class="text-danger">*</strong></label>
                        <select name="pickup" id="selectPickup" class="form-select" aria-label="Default select example">
                            <option value="" selected>Select</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area_name }}({{ $area->pickup_point }})</option>
                            @endforeach
                            
                        </select>
                        @error('pickup')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gub_id" class="form-label">Select Day <strong class="text-danger">*</strong></label>
                        <select name="day" id="selectDay" class="form-select" aria-label="Default select example">
                            <option value="" selected>Select</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                        </select>
                        @error('day')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
            </div>
            
            
            <button class="btn btn-primary" type="submit">Find</button>
        </form>
    </div>
</div>

@isset($routeVehicles)
<div class="card mt-5">
    <div class="card-header">
        <h4 class="text-center">Vehicle List</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="20%" style="padding: 5px">Route name</th>
                        <th width="20%" style="padding: 5px">Pickup</th>
                        <th width="20%" style="padding: 5px">Pickup Time</th>
                        <th width="20%" style="padding: 5px">Vehicle</th>
                        <th width="20%" style="padding: 5px">Driver Name</th>
                        <th width="20%" style="padding: 5px">Driver Contact</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($routeVehicles as $routeVehicle)
                <tr>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->route->route_name }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->pickupArea->area_name }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->pickup_time }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->vehicle->vehicle_number }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->vehicle->driver->name }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->vehicle->driver->phone }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6"><p class="text-center">No Vehicle Found</p></td>
                </tr>
                @endforelse
    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endisset

<script>

$(document).ready(function() {
            $('#selectDay').select2({
                placeholder: "Select Day",
                allowClear: true
            });
        });
</script>

@endsection