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
                        <li class="breadcrumb-item" aria-current="page">Vehicle</li>
                        <li class="breadcrumb-item active" aria-current="page">All Vehicles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-8">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Vehicle List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%" style="padding: 5px">GUB Seiral number</th>
                                <th width="20%" style="padding: 5px">Image</th>
                                <th width="20%" style="padding: 5px">Vehicle Number</th>
                                <th width="15%" style="padding: 5px">Driver</th>
                                <th width="25%" style="padding: 5px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($vehicles as $vehicle)
                        <tr>
                            <td width="20%" style="padding: 5px">{{ $vehicle->serial_number }}</td>
                            <td width="20%" style="padding: 5px">
                                <img class="" style="width: 70px; height:auto" src="{{ !empty($vehicle->image) ? asset($vehicle->image) : url('upload/noimage.jpg') }}" alt="">
                            </td>
                            <td width="20%" style="padding: 5px">{{ $vehicle->vehicle_number }}</td>
                            <td width="15%" style="padding: 5px">{{ $vehicle->driver->name }}</td>
                            <td width="25%" style="padding: 5px" class="text-center">
                                <a href="{{ route('admin.vehicle.edit', $vehicle->id) }}" class="btn btn-sm mx-1 btn-info mb-1" title="Edit Data"><i class="fa fa-pencil "></i></a>
                                <a href="{{ route('admin.vehicle.delete', $vehicle->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger mb-1" title="Delete Data"><i class="fa fa-trash "></i></a>
                            </td>
                        </tr>
                        @empty
                        @endforelse

                        </tbody>
                        </table>
                    </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-8 --}}
        <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Vehicle</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.vehicle.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>GUB Serial Number <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="serial_number" value="{{ old('serial_number') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('serial_number')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Vehicle Number <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="vehicle_number" value="{{ old('vehicle_number') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('vehicle_number')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Driver <span class="text-danger"></span></h5>
                            <div class="controls">
                                <select name="driver_id" id="select" class="form-control" aria-invalid="false">
                                    <option value="" selected>Select Driver</option>
                                    @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('driver_id')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div> {{-- end form group --}}
                        <div class="form-group">
                            <h5>Vehicle Image <span class="text-danger"></span></h5>
                            <img id="showImage" class="avatar-bordered" style="width: 150px; height:auto" src="" alt="">
                            <div class="controls" style="margin-top:15px">
                                <input id="image" type="file" name="image" class="form-control"> <div class="help-block"></div></div>
                            @error('image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <h5>Description <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="description" value="{{ old('description') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('description')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Vehicle">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>



{{-- show selected image with jquery --}}
<script type="text/javascript">
    $(document).ready(function(){
        /* profile image */
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

    });
</script>




@endsection