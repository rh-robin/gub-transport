@extends('user_master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-center">Your Profile Data</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.profile.submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="gub_id" class="form-label">Id <strong class="text-danger">*</strong></label>
                <input type="text" name="gub_id" value="{{ $user->gub_id }}" class="form-control" id="gub_id" readonly>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name <strong class="text-danger">*</strong></label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" readonly>
                
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone <strong class="text-danger">*</strong></label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="phone">
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                @error('email')
                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label d-block"> Image <strong class="text-danger"></strong></label>
                <img class="mb-3" style="width: 200px; height:auto" src="{{ !empty($user->image) ? asset($user->image) : url('upload/noimage.jpg') }}" alt="">
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>

@endsection