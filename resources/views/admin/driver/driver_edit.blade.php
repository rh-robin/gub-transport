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
                        <li class="breadcrumb-item" aria-current="page">Driver</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Driver</li>
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
                 <h3 class="box-title">Edit Driver Data</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.driver.update', $driver->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>GUB ID <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="gub_id" value="{{ old('gub_id') ? old('gub_id') : $driver->gub_id }}" class="form-control"> <div class="help-block"></div></div>
                            @error('gub_id')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Driver Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{ old('name') ? old('name') : $driver->name }}" class="form-control"> <div class="help-block"></div></div>
                            @error('name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Profile Image <span class="text-danger"></span></h5>
                            <img id="showImage" class="avatar-bordered" style="width: 200px; height:auto" src="{{ !empty($driver->image) ? asset($driver->image) : url('upload/noimage.jpg') }}" alt="">
                            <div class="controls" style="margin-top:15px">
                                <input id="image" type="file" name="image" class="form-control"> <div class="help-block"></div></div>
                            @error('image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Phone <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $driver->phone }}" class="form-control"> <div class="help-block"></div></div>
                            @error('phone')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Email <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" name="email" value="{{ old('email') ? old('email') : $driver->email }}" class="form-control"> <div class="help-block"></div></div>
                            @error('email')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <h5>License No. <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="license_no" value="{{ old('license_no') ? old('license_no') : $driver->license_no }}" class="form-control"> <div class="help-block"></div></div>
                            @error('license_no')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>License Image <span class="text-danger"></span></h5>
                            <img id="showLicenseImage" class="avatar-bordered" style="width: 200px; height:auto" src="{{ !empty($driver->license_image) ? asset($driver->license_image) : url('upload/noimage.jpg') }}" alt="">
                            <div class="controls" style="margin-top:15px">
                                <input id="licenseImage" type="file" name="license_image" class="form-control"> <div class="help-block"></div></div>
                            @error('license_image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Address <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="address" value="{{ old('address') ? old('address') : $driver->address }}" class="form-control"> <div class="help-block"></div></div>
                            @error('address')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Driver">
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

        /* license image */
        $('#licenseImage').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showLicenseImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>




@endsection