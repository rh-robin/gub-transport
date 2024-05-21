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
                        <li class="breadcrumb-item active" aria-current="page">All Drivers</li>
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
                 <h3 class="box-title">Driver List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th width="20%" style="padding: 5px">Image</th>
                               <th width="20%" style="padding: 5px">Driver id</th>
                               <th width="20%" style="padding: 5px">Name</th>
                               <th width="15%" style="padding: 5px">phone</th>
                               <th width="20%" style="padding: 5px">Bus no.</th>
                               <th width="25%" style="padding: 5px">Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($drivers as $driver)
                        <tr>
                            <td width="20%" style="padding: 5px">
                                <img class="" style="width: 70px; height:auto" src="{{ !empty($driver->image) ? asset($driver->image) : url('upload/noimage.jpg') }}" alt="">
                            </td>
                            <td width="20%" style="padding: 5px">{{ $driver->gub_id }}</td>
                            <td width="20%" style="padding: 5px">{{ $driver->name }}</td>
                            <td width="15%" style="padding: 5px">{{ $driver->phone }}</td>
                            <td width="20%" style="padding: 5px">{{ $driver->phone }}</td>
                            <td width="25%" style="padding: 5px" class="text-center">
                             <a href="{{ route('admin.driver.edit', $driver->id) }}" class="btn btn-sm mx-1 btn-info mb-1" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('admin.driver.delete', $driver->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger mb-1" title="Delete Data"><i class="fa fa-trash "></i></a>
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
                 <h3 class="box-title">Add Driver</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.driver.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>GUB ID <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="gub_id" value="{{ old('gub_id') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('gub_id')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Driver Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Profile Image <span class="text-danger"></span></h5>
                            <img id="showImage" class="avatar-bordered" style="width: 150px; height:auto" src="" alt="">
                            <div class="controls" style="margin-top:15px">
                                <input id="image" type="file" name="image" class="form-control"> <div class="help-block"></div></div>
                            @error('image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Phone <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('phone')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Email <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('email')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <h5>License No. <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="license_no" value="{{ old('license_no') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('license_no')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>License Image <span class="text-danger"></span></h5>
                            <img id="showLicenseImage" class="avatar-bordered" style="width: 150px; height:auto" src="" alt="">
                            <div class="controls" style="margin-top:15px">
                                <input id="licenseImage" type="file" name="license_image" class="form-control"> <div class="help-block"></div></div>
                            @error('license_image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Address <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('address')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Driver">
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