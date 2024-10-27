@extends('admin.admin_master')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xl-3 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-primary-light rounded w-60 h-60">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Slot Request</p>
                        <h3 class="text-white mb-0 font-weight-500">{{ $numberOfRequest }} </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-primary-light rounded w-60 h-60">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Route</p>
                        <h3 class="text-white mb-0 font-weight-500">{{ $numberOfRoutes }} </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-primary-light rounded w-60 h-60">
                        <i class="fa-solid fa-bus"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Vehicle</p>
                        <h3 class="text-white mb-0 font-weight-500">{{ $numberOfVehicles }} </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6">
            <div class="box overflow-hidden pull-up">
                <div class="box-body">							
                    <div class="icon bg-primary-light rounded w-60 h-60">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <p class="text-mute mt-20 mb-0 font-size-16">Driver</p>
                        <h3 class="text-white mb-0 font-weight-500">{{ $numberOfDrivers }} </h3>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection