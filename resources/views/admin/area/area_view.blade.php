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
                        <li class="breadcrumb-item active" aria-current="page">All Pickup Areas</li>
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
                 <h3 class="box-title">Pickup Area List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%" style="padding: 5px">Ara name</th>
                                <th width="20%" style="padding: 5px">Pickup point</th>
                                <th width="25%" style="padding: 5px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($areas as $area)
                        <tr>
                            <td width="20%" style="padding: 5px">{{ $area->area_name }}</td>
                            <td width="20%" style="padding: 5px">{{ $area->pickup_point }}</td>
                            <td width="25%" style="padding: 5px" class="text-center">
                                <a href="{{ route('admin.area.edit', $area->id) }}" class="btn btn-sm mx-1 btn-info mb-1" title="Edit Data"><i class="fa fa-pencil "></i></a>
                                <a href="{{ route('admin.area.delete', $area->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger mb-1" title="Delete Data"><i class="fa fa-trash "></i></a>
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
                 <h3 class="box-title">Add Pickup Area</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('admin.area.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Area Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="area_name" value="{{ old('area_name') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('area_name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Pickup Point <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pickup_point" value="{{ old('pickup_point') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('pickup_point')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
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