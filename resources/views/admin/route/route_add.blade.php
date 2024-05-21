@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Driver</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Area</li>
                        <li class="breadcrumb-item active" aria-current="page">Add  Route</li>
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
                 <h3 class="box-title">Add Route</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.area.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Route Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="route_name" value="{{ old('route_name') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('route_name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Pickup Point <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="pickup_area_id" id="select" class="form-control" aria-invalid="false">
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
                        <div class="form-group">
                            <h5>Pickup Time <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="time" name="pickup_time" value="{{ old('pickup_time') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('pickup_time')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Vehicle <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="vehicle_id" id="select" class="form-control" aria-invalid="false">
                                    <option value="" selected>Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('pickup_area_id')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div> {{-- end form group --}}
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Area">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>








@endsection