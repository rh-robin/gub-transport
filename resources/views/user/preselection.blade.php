@extends('user_master')
@section('content')
    <h2 class="text-center">Pre-selection</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('user.preselection.submit') }}" method="post">
        @csrf

        @if(isset($msg))
        <div class="alert alert-danger">
            <span>{{ $msg }}</span>
        </div>
        @else
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    @error('route_vehicle_id.*')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    <tr>
                        <th width="20%" style="padding: 5px">Route name</th>
                        <th width="20%" style="padding: 5px">Pickup</th>
                        <th width="20%" style="padding: 5px">Pickup Time</th>
                        <th width="2%" style="padding: 5px">Days</th>
                        <th width="2%" style="padding: 5px">Select</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($routeVehicles as $routeVehicle)
                <tr>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->route->route_name }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->pickupArea->area_name }}({{ $routeVehicle->pickupArea->pickup_point }})</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->pickup_time }}</td>
                    <td width="20%" style="padding: 5px">{{ $routeVehicle->days }}</td>
                    <td width="25%" style="padding: 5px" class="text-center">
                        <input class="" type="checkbox" name="route_vehicle_id[]" value="{{ $routeVehicle->id }}">
                    </td>
                </tr>
                @empty
                @endforelse
    
                </tbody>
            </table>
        </div>

        @endif


        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Request for vehicle</h5>
            </div>
            <div class="card-body request-container">
                <div class="row request-row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="pickup_point" class="form-label">Pickup Point <strong class="text-danger">*</strong></label>
                            <input type="text" name="pickup_point[]" value="" class="form-control" id="pickup_point" >
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="class_time" class="form-label">Class Starting Time <strong class="text-danger">*</strong></label>
                            <input type="time" name="class_time[]" value="" class="form-control" id="class_time" >
                        </div>
                        @error('class_time.*')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="mb-3">
                            <a href="javascript:;" class="btn btn-warning" onclick="addRequestRow()">Add more</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="hidden" name="days[]" value="" class="form-control days-input">
                            <input type="checkbox" class="btn-check" id="saturday" value="saturday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="saturday">Saturday</label>
        
                            <input type="checkbox" class="btn-check" id="sunday" value="sunday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="sunday">Sunday</label>
        
                            <input type="checkbox" class="btn-check" id="monday" value="monday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="monday">Monday</label>
        
                            <input type="checkbox" class="btn-check" id="tuesday" value="tuesday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="tuesday">Tuesday</label>
        
                            <input type="checkbox" class="btn-check" id="wednesday" value="wednesday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="wednesday">Wednesday</label>
        
                            <input type="checkbox" class="btn-check" id="thursday" value="thursday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="thursday">Thursday</label>
        
                            <input type="checkbox" class="btn-check" id="friday" value="friday" autocomplete="off" onchange="updateDaysInput(this)">
                            <label class="btn btn-outline-primary" for="friday">Friday</label>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="mt-4">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>


<script>
    let n =1;
    function addRequestRow(){
        let requestContainer = document.querySelector('.request-container');
        let hr = document.createElement('hr');
        requestContainer.appendChild(hr);
        let requestRow = document.createElement('div');
        requestRow.classList.add('row', 'request-row');
        requestRow.innerHTML = `
        <div class="col-md-5">
            <div class="mb-3">
                <label for="pickup_point" class="form-label">Pickup Point <strong class="text-danger">*</strong></label>
                <input type="text" name="pickup_point[]" value="" class="form-control" id="pickup_point" >
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="class_time" class="form-label">Class Starting Time <strong class="text-danger">*</strong></label>
                <input type="time" name="class_time[]" value="" class="form-control" id="class_time" >
            </div>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <div class="mb-3">
                <a href="javascript:;" class="btn btn-warning" onclick="removeRequestRow(this)">Remove</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="hidden" name="days[]" value="" class="form-control days-input">
                <input type="checkbox" class="btn-check" id="saturday${n}" value="saturday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="saturday${n}">Saturday</label>

                <input type="checkbox" class="btn-check" id="sunday${n}" value="sunday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="sunday${n}">Sunday</label>

                <input type="checkbox" class="btn-check" id="monday${n}" value="monday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="monday${n}">Monday</label>

                <input type="checkbox" class="btn-check" id="tuesday${n}" value="tuesday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="tuesday${n}">Tuesday</label>

                <input type="checkbox" class="btn-check" id="wednesday${n}" value="wednesday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="wednesday${n}">Wednesday</label>

                <input type="checkbox" class="btn-check" id="thursday${n}" value="thursday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="thursday${n}">Thursday</label>

                <input type="checkbox" class="btn-check" id="friday${n}" value="friday" autocomplete="off" onchange="updateDaysInput(this)">
                <label class="btn btn-outline-primary" for="friday${n}">Friday</label>
            </div>
        </div>
        `;
        requestContainer.appendChild(requestRow);
        n++;
    }

    function removeRequestRow(button) {
        let requestRow = button.closest('.request-row');
        requestRow.remove();
    }

    function updateDaysInput(checkbox) {
        let row = checkbox.closest('.request-row');
        let daysInput = row.querySelector('.days-input');
        let checkedBoxes = row.querySelectorAll('.btn-check:checked');
        let days = Array.from(checkedBoxes).map(cb => cb.value).join(',');
        daysInput.value = days;
    }
    
</script>
@endsection