@extends('admin.admin_master')

@push('styles')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
    </style>
@endpush

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
                        <li class="breadcrumb-item active" aria-current="page">All Selections</li>
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
                <div class="box-header with-border d-flex justify-content-between">
                        <h3 class="box-title">All Selections</h3>
                        <label class="switch">
                            <input type="checkbox" {{ $userSiteSetting->preselection == "on" ? "checked" : "" }} onchange="selectionOnOff(this)">
                            <span class="slider round"></span>
                        </label>
                        
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
                                <th width="20%" style="padding: 5px">Days</th>
                                <th width="25%" style="padding: 5px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        {{-- {{  dd($preSelections[0]->vehicleInRoute->pickupArea)}} --}}

                        @foreach ($preSelections as $preSelection)
                            
                        <tr>
                            <td width="20%" style="padding: 5px">{{ $preSelection->vehicleInRoute->route->route_name }}</td>
                            <td width="20%" style="padding: 5px">{{ $preSelection->vehicleInRoute->pickupArea->area_name }}({{ $preSelection->vehicleInRoute->pickupArea->pickup_point }})</td>
                            <td width="20%" style="padding: 5px">{{ \Carbon\Carbon::createFromFormat('H:i', $preSelection->vehicleInRoute->pickup_time)->format('h:i A') }}
                            </td>
                            {{-- <td width="20%" style="padding: 5px" class="text-center">
                                 <a href="{{ route('admin.route.delete', $route->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger mb-1" title="Delete Data"><i class="fa fa-trash "></i></a>
                            </td> --}}
                            <td width="20%" style="padding: 5px">{{ $preSelection->vehicleInRoute->days }}</td>
                            <td width="20%" style="padding: 5px">{{ $preSelection->numberOfUser }}</td>
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


    <script>
        function selectionOnOff(input){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/admin/preselection/selection-on-off",
                success: function(data){
                    //console.log(data);
                }
            });
        }
    </script>

</section>








@endsection