@extends('driver.driver_master')

@section('title')
Driver Profile
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Your Profile Data</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Id <strong class="text-danger">*</strong></label>
                    <input type="text" name="gub_id" value="{{ $driver->gub_id }}" class="form-control" id="name" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name <strong class="text-danger">*</strong></label>
                    <input type="text" name="name" value="{{ $driver->name }}" class="form-control" id="name" readonly>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone <strong class="text-danger">*</strong></label>
                    <input type="text" name="phone" value="{{ $driver->phone }}" class="form-control" id="phone" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $driver->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="license_no" class="form-label">License Number <strong class="text-danger"></strong></label>
                    <input type="text" name="license_no" value="{{ $driver->license_no }}" class="form-control" id="license_no" readonly>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label d-block">License Image <strong class="text-danger"></strong></label>
                    <img class="avatar-bordered" style="width: 200px; height:auto" src="{{ !empty($driver->license_image) ? asset($driver->license_image) : url('upload/noimage.jpg') }}" alt="">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address <strong class="text-danger"></strong></label>
                    <input type="text" name="address" value="{{ $driver->address }}" class="form-control" id="address" readonly>
                </div>
            </form>
        </div>
    </div>
@endsection