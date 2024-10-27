// script.js

function addVehicleRow() {
    console.log("clicked");
    let vehicleContainer = document.getElementById("vehicleContainer");
    let selectedVehicles = new Set();
    // Get all selected vehicles from existing rows
    vehicleContainer.querySelectorAll('.vehicle-row select[name="vehicle_id"]').forEach(function(select) {
        selectedVehicles.add(select.value);
    });

    let vehiclesHTML = '';
    // Generate options for vehicles excluding the selected ones
    vehiclesData.forEach(function(vehicle) {
        if (!selectedVehicles.has(vehicle.id.toString())) {
            vehiclesHTML += '<option value="' + vehicle.id + '">' + vehicle.vehicle_number + '</option>';
        }
    });

    let vehicleRow = document.createElement('div');
    vehicleRow.classList.add('row', 'vehicle-row');
    vehicleRow.innerHTML = `
        <div class="col-md-2">
            <div class="form-group">
                <h5>Select Vehicle <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="vehicle_id" class="form-control" aria-invalid="false">
                        <option value="" selected>Select Vehicle</option>
                        ${vehiclesHTML}
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <div class="controls">
                    <select name="vehicle_id" id="select" class="form-control" aria-invalid="false">
                        <option value="" selected>Select Vehicle</option>
                        <option value="">Permanent Campus</option>
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
                    <input type="time" name="pickup_time" value="{{ old('pickup_time') }}" class="form-control"> <div class="help-block"></div></div>
                @error('pickup_time')
                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div>
        </div> {{-- end col --}}
        <div class="col-md-3">
            <div class="form-group">
                <div class="controls">
                    <input type="text" name="duration" id="duration" placeholder="Duration in minutes" class="form-control">
                </div>
                @error('pickup_area_id')
                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div> {{-- end form group --}}
        </div> {{-- end col --}}
        <div class="col-md-3 d-flex align-items-start" style="">
            <button class="btn btn-warning" onclick="removeVehicleRow(this)" style="padding: 2px 10px;">Remove</button>
        </div>
    `;
    vehicleContainer.appendChild(vehicleRow);
}

function removeVehicleRow(button) {
    let vehicleRow = button.closest('.vehicle-row');
    vehicleRow.remove();
}
