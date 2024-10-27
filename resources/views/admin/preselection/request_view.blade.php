@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Pre-selection</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Pre-selection</li>
                        <li class="breadcrumb-item active" aria-current="page">All Requests</li>
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
                 <h3 class="box-title">All Requested Slots</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%" style="padding: 5px">Pickup Point</th>
                                <th width="20%" style="padding: 5px">Class Time</th>
                                <th width="20%" style="padding: 5px">Days</th>
                                <th width="25%" style="padding: 5px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        {{-- {{  dd($allRequest)}} --}}

                        @foreach ($allRequest as $request)
                            
                        <tr>
                            <td width="20%" style="padding: 5px">{{ $request->pickup_point }}</td>
                            <td width="20%" style="padding: 5px">{{ \Carbon\Carbon::createFromFormat('H:i', $request->class_time)->format('h:i A') }}
                            </td>
                            {{-- <td width="20%" style="padding: 5px" class="text-center">
                                 <a href="{{ route('admin.route.delete', $route->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger mb-1" title="Delete Data"><i class="fa fa-trash "></i></a>
                            </td> --}}
                            <td width="20%" style="padding: 5px">{{ $request->days }}</td>
                            <td width="20%" style="padding: 5px">{{ $request->numberOfUsers }}</td>
                        </tr>
                        @endforeach
                        
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