@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Area</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Area</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Pickup Area</li>
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
                 <h3 class="box-title">Edit Pickup Area</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.area.update', $area->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Area Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="area_name" value="{{ old('area_name') ? old('area_name') : $area->area_name }}" class="form-control"> <div class="help-block"></div></div>
                            @error('area_name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Pickup Point <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pickup_point" value="{{ old('pickup_point') ? old('pickup_point') : $area->pickup_point }}" class="form-control"> <div class="help-block"></div></div>
                            @error('pickup_point')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Area">
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