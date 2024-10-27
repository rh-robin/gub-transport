@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                        <li class="breadcrumb-item active" aria-current="page">All Routes</li>
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
                 <h3 class="box-title">Route List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%" style="padding: 5px">Route name</th>
                                <th width="20%" style="padding: 5px">Pickup</th>
                                <th width="20%" style="padding: 5px">Pickup Time</th>
                                <th width="25%" style="padding: 5px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($routes as $route)
                        <tr>
                            <td width="20%" style="padding: 5px">{{ $route->route_name }}</td>
                            <td width="20%" style="padding: 5px">{{ $route->mainDeparture->area_name }}</td>
                            <td width="20%" style="padding: 5px">{{ $route->pickupTime->pickup_time }}</td>
                            <td width="25%" style="padding: 5px" class="text-center">
                                <a href="{{ route('admin.route.edit', $route->id) }}" class="btn btn-sm mx-1 btn-info mb-1" title="Edit Data"><i class="fa fa-pencil "></i></a>
                                <a href="{{ route('admin.route.delete', $route->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger mb-1" title="Delete Data"><i class="fa fa-trash "></i></a>
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
    </div> {{-- end row --}}

</section>








@endsection