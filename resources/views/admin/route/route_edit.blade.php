@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Route</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Route</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit  Route</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Route</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.route.update', $route->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Route Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="route_name" value="{{ $route->route_name }}" class="form-control"> <div class="help-block"></div></div>
                                    @error('route_name')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Main Departure Location <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="main_departure" id="selectDeparture" class="form-control" aria-invalid="false">
                                            <option value="" >Select Departure</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" {{ $area->id == $route->main_departure ? "selected" : "" }}>{{ $area->area_name }}({{ $area->pickup_point }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('main_departure')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>
                        </div> {{-- end row --}}
                        {{-- {{ dd($route->vehicleInRoutes[0]->vehicle_id) }} --}}
                        <div class="vehicle-container" id="vehicleContainer">
                            <div class="row vehicle-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Select Vehicle <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="hidden" name="old_route_vehicle_id[]" value="{{$route->vehicleInRoutes[0]->id}}">
                                            <select name="vehicle_id[]" id="selectVehicle" class="form-control" aria-invalid="false">
                                                <option value="" selected>Select Vehicle</option>
                                                @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" {{ $vehicle->id == $route->vehicleInRoutes[0]->vehicle_id ? "selected" : "" }}>{{ $vehicle->vehicle_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('vehicle_id.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div> {{-- end form group --}}
                                </div> {{-- end col --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Pickup <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="pickup_area_id[]" id="selectPickup" class="form-control" aria-invalid="false">
                                                <option value="" selected>Select Pickup Point</option>
                                                @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" {{ $area->id == $route->vehicleInRoutes[0]->pickup_area_id ? "selected" : "" }}>{{ $area->area_name }}({{ $area->pickup_point }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('pickup_area_id.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div> {{-- end form group --}}
                                </div> {{-- end col --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5>Pickup Time <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="time" name="pickup_time[]" value="{{ $route->vehicleInRoutes[0]->pickup_time }}" class="form-control"> <div class="help-block"></div></div>
                                        @error('pickup_time.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div> {{-- end col --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5>Arrive Time <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="time" name="arrive_time[]" value="{{ $route->vehicleInRoutes[0]->arrive_time }}" class="form-control"> <div class="help-block"></div></div>
                                        @error('arrive_time.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div> {{-- end col --}}
                                <div class="col-md-2 d-flex align-items-center" style="padding-top: 14px;">
                                    <buttton class="btn btn-warning" onclick="addVehicleRow()" style="padding: 2px 10px;">Add more</buttton>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="days[]" value="{{ $route->vehicleInRoutes[0]->days }}">
                                    <input type="checkbox" id="saturday" value="saturday">
						            <label style="margin-right: 30px;" for="saturday">Saturday</label>
                                    <input type="checkbox" id="sunday" value="sunday">
						            <label style="margin-right: 30px;" for="sunday">Sunday</label>
                                    <input type="checkbox" id="monday" value="monday">
						            <label style="margin-right: 30px;" for="monday">Monday</label>
                                    <input type="checkbox" id="tuesday" value="tuesday">
						            <label style="margin-right: 30px;" for="tuesday">Tuesday</label>
                                    <input type="checkbox" id="wednesday" value="wednesday">
						            <label style="margin-right: 30px;" for="wednesday">Wednesday</label>
                                    <input type="checkbox" id="thursday" value="thursday">
						            <label style="margin-right: 30px;" for="thursday">Thursday</label>
                                    <input type="checkbox" id="friday" value="friday">
						            <label style="margin-right: 30px;" for="friday">Friday</label>
                                    @error('days.*')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-control-feedback"><small class="text-danger" id="availability"></small></div>
                            </div> {{-- end row --}}


                        @foreach ($route->vehicleInRoutes->slice(1) as $vehicleInRoute)
                        
                            <div class="row vehicle-row">
                                <hr style="width:100%; padding: 5px 0;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="hidden" name="old_route_vehicle_id[]" value="{{$vehicleInRoute->id}}">
                                            <select name="vehicle_id[]" id="selectVehicle" class="form-control" aria-invalid="false">
                                                <option value="" selected>Select Vehicle</option>
                                                @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" {{ $vehicle->id == $vehicleInRoute->vehicle_id ? "selected" : "" }}>{{ $vehicle->vehicle_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('vehicle_id.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div> {{-- end form group --}}
                                </div> {{-- end col --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            <select name="pickup_area_id[]" id="selectPickup" class="form-control" aria-invalid="false">
                                                <option value="" selected>Select Pickup Point</option>
                                                @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" {{ $area->id == $vehicleInRoute->pickup_area_id ? "selected" : "" }}>{{ $area->area_name }}({{ $area->pickup_point }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('pickup_area_id.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div> {{-- end form group --}}
                                </div> {{-- end col --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="time" name="pickup_time[]" value="{{ $vehicleInRoute->pickup_time }}" class="form-control"> <div class="help-block"></div></div>
                                        @error('pickup_time.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div> {{-- end col --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="time" name="arrive_time[]" value="{{ $vehicleInRoute->arrive_time }}" class="form-control"> <div class="help-block"></div></div>
                                        @error('arrive_time.*')
                                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div> {{-- end col --}}
                                <div class="col-md-2 d-flex align-items-start" style="">
                                    <buttton class="btn btn-warning" onclick="removeVehicleRow(this)" style="padding: 2px 10px;">Remove</buttton>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="days[]" value="{{ $vehicleInRoute->days }}">
                                    <input type="checkbox" id="saturday_{{$loop->index}}" value="saturday">
						            <label style="margin-right: 30px;" for="saturday_{{$loop->index}}">Saturday</label>
                                    <input type="checkbox" id="sunday_{{$loop->index}}" value="sunday">
						            <label style="margin-right: 30px;" for="sunday_{{$loop->index}}">Sunday</label>
                                    <input type="checkbox" id="monday_{{$loop->index}}" value="monday">
						            <label style="margin-right: 30px;" for="monday_{{$loop->index}}">Monday</label>
                                    <input type="checkbox" id="tuesday_{{$loop->index}}" value="tuesday">
						            <label style="margin-right: 30px;" for="tuesday_{{$loop->index}}">Tuesday</label>
                                    <input type="checkbox" id="wednesday_{{$loop->index}}" value="wednesday">
						            <label style="margin-right: 30px;" for="wednesday_{{$loop->index}}">Wednesday</label>
                                    <input type="checkbox" id="thursday_{{$loop->index}}" value="thursday">
						            <label style="margin-right: 30px;" for="thursday_{{$loop->index}}">Thursday</label>
                                    <input type="checkbox" id="friday_{{$loop->index}}" value="friday">
						            <label style="margin-right: 30px;" for="friday_{{$loop->index}}">Friday</label>
                                    @error('days.*')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-control-feedback"><small class="text-danger" id="availability"></small></div>
                            </div>
                        @endforeach


                        </div>

                        <div class="form-group">
                            <h5>Note <span class="text-danger"></span></h5>
                            <div class="controls">
                                <textarea class="form-control" name="instruction">{{ old('instruction') ? old('instruction') : $route->instruction }}</textarea> <div class="help-block">If any instrustion</div></div>
                            @error('instruction')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Route">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>


<script>
    let n =0;
    function addVehicleRow(){
        
        let vahicleContainer = document.getElementById("vehicleContainer");
        let selectedVehicles = new Set();
        // Get all selected vehicles from existing rows
        vehicleContainer.querySelectorAll('.vehicle-row select[name="vehicle_id"]').forEach(function(select) {
            selectedVehicles.add(select.value);
        });

        let vehiclesHTML = '';
        // Generate options for vehicles excluding the selected ones
        @foreach ($vehicles as $vehicle)
            //if (!selectedVehicles.has("{{ $vehicle->id }}")) {
                vehiclesHTML += '<option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>';
            //}
        @endforeach
        let vehicleRow = document.createElement('div');
        vehicleRow.classList.add('row', 'vehicle-row');
        vehicleRow.innerHTML = `
                <hr style="width:100%; padding: 5px 0;">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="controls">
                            <select name="vehicle_id[]" id="" class="form-control selectVehicle" aria-invalid="false">
                                <option value="" selected>Select Vehicle</option>
                                ${vehiclesHTML}
                            </select>
                            
                        </div>
                        @error('vehicle_id')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div> {{-- end form group --}}
                </div> {{-- end col --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="controls">
                            <select name="pickup_area_id[]" id="" class="form-control selectPickup" aria-invalid="false">
                                <option value="" selected>Select Pickup Point</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area_name }}({{ $area->pickup_point }})</option>
                                @endforeach
                            </select>
                        </div>
                        @error('pickup_area_id')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div> {{-- end form group --}}
                </div> {{-- end col --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="controls">
                            <input type="time" name="pickup_time[]" value="" class="form-control"> <div class="help-block"></div></div>
                        @error('pickup_time')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div> {{-- end col --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="controls">
                            <input type="time" name="arrive_time[]" value="" class="form-control"> <div class="help-block"></div></div>
                        @error('arrive_time')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div> {{-- end col --}}
                <div class="col-md-2 d-flex align-items-start" style="">
                        <buttton class="btn btn-warning" onclick="removeVehicleRow(this)" style="padding: 2px 10px;">Remove</buttton>
                </div>
                <div class="col-12">
                    <input type="hidden" name="days[]" value="">
                    <input type="checkbox" id="saturday${n}" value="saturday">
                    <label style="margin-right: 30px;" for="saturday${n}">Saturday</label>
                    <input type="checkbox" id="sunday${n}" value="sunday">
                    <label style="margin-right: 30px;" for="sunday${n}">Sunday</label>
                    <input type="checkbox" id="monday${n}" value="monday">
                    <label style="margin-right: 30px;" for="monday${n}">Monday</label>
                    <input type="checkbox" id="tuesday${n}" value="tuesday">
                    <label style="margin-right: 30px;" for="tuesday${n}">Tuesday</label>
                    <input type="checkbox" id="wednesday${n}" value="wednesday">
                    <label style="margin-right: 30px;" for="wednesday${n}">Wednesday</label>
                    <input type="checkbox" id="thursday${n}" value="thursday">
                    <label style="margin-right: 30px;" for="thursday${n}">Thursday</label>
                    <input type="checkbox" id="friday${n}" value="friday">
                    <label style="margin-right: 30px;" for="friday${n}">Friday</label>
                </div>
                <div class="form-control-feedback"><small class="text-danger" id="availability"></small></div>
        `;
        vahicleContainer.appendChild(vehicleRow);
        
        // Initialize Select2 on the newly added select elements
        $(vehicleRow).find('.selectVehicle').select2({
            placeholder: "Select Vehicle",
            allowClear: true
        });

        $(vehicleRow).find('.selectPickup').select2({
            placeholder: "Select Pickup Point",
            allowClear: true
        });

        // Add event listener to checkboxes for each row
        let checkboxes = vehicleRow.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateSelectedDays(vehicleRow);

                let checkboxValue = null;
                let isChecked = checkbox.checked;
                if (isChecked) {
                    console.log(isChecked);
                    checkboxValue = checkbox.value;
                }
                let pickupTime = vehicleRow.querySelector('input[name="pickup_time[]"]').value;
                let arriveTime = vehicleRow.querySelector('input[name="arrive_time[]"]').value;
                let vehicleID = vehicleRow.querySelector('select[name="vehicle_id[]"]').value;
                isAvailable(vehicleRow, checkboxValue, pickupTime, arriveTime, vehicleID);
            });
        });
        n = n+1;
    }

    // Add event listeners to checkboxes in all existing rows
    document.querySelectorAll('.vehicle-row').forEach(function(vehicleRow) {
        initializeCheckboxes(vehicleRow)
        let checkboxes = vehicleRow.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateSelectedDays(vehicleRow);

                let checkboxValue = null;
                let isChecked = checkbox.checked;
                if (isChecked) {
                    checkboxValue = checkbox.value;
                }
                let pickupTime = vehicleRow.querySelector('input[name="pickup_time[]"]').value;
                let arriveTime = vehicleRow.querySelector('input[name="arrive_time[]"]').value;
                let vehicleID = vehicleRow.querySelector('select[name="vehicle_id[]"]').value;
                console.log(vehicleRow, checkboxValue, pickupTime, arriveTime, vehicleID);
                isAvailable(vehicleRow, checkboxValue, pickupTime, arriveTime, vehicleID);
            });
        });
    });

    /* ===== check the vehicle is available or not on selected schedule ======= */
    function isAvailable(row, checkboxValue, pickupTime, arriveTime, vehicleID){
        // Prepare data to send
        const data = {
            checkboxValue: checkboxValue,
            pickupTime: pickupTime,
            arriveTime: arriveTime,
            vehicleID: vehicleID
        };
        // Send AJAX request using jQuery
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/admin/route/vehicle/check-availability",
            data: data,
            success: function(data){
                console.log(data);
                if(data>0){
                    row.querySelector('#availability').innerText = "This vehicle is not availble on this schedule";
                }else{
                    row.querySelector('#availability').innerText = "";
                }
            }
        });
    }

    // Function to update the hidden days field with selected days
    function updateSelectedDays(row) {
        let checkedDays = [];
        row.querySelectorAll('input[type="checkbox"]:checked').forEach(function(checkbox) {
            checkedDays.push(checkbox.value);
        });
        row.querySelector('input[name="days[]"]').value = checkedDays.join(',');
    }

    function initializeCheckboxes(row) {
        let daysValue = row.querySelector('input[name="days[]"]').value;
        if (daysValue) {
            let daysArray = daysValue.split(',');
            daysArray.forEach(function(day) {
                let checkbox = row.querySelector('input[type="checkbox"][value="' + day + '"]');
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        }
    }

    function removeVehicleRow(button) {
        let vehicleRow = button.closest('.vehicle-row');
        vehicleRow.remove();
    }
    
</script>
<script>
    $(document).ready(function() {
        $('#selectDeparture').select2({
            placeholder: "Select Departure",
            allowClear: true
        });
        $('#selectPickup').select2({
            placeholder: "Select Pickup Point",
            allowClear: true
        });
        $('#selectVehicle').select2({
            placeholder: "Select Vehicle",
            allowClear: true
        });
    });
</script>





@endsection