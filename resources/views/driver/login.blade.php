<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Driver login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4"></div>
            <div class="col-md-4 py-5">
                <div class="card" style="">
                    <div class="card-header">
                        <h3 class="text-center">Driver Login</h3>
                    </div>
        
                    <div class="card-body">
                        @if($errors->any())
                            @foreach ( $errors->all() as $error )
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        @endif
        
                        @if(Session::has('error'))
                            <li style="color: red">{{ Session::get('error') }}</li>
                        @endif
        
                        @if (Session::has('success'))
                            <li style="color: green">{{ Session::get('success') }}</li>
                        @endif
        
                        <form action="{{ route('driver.login_submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label for="gub_id" class="form-label">Gub Id</label>
                            <input type="gub_id" name="gub_id" class="form-control" id="gub_id" >
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" >
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.forgetPassword') }}">Forgot Password</a>
                        <br><br>
                        <a href=""></a>
                    </div>
                </div>
            </div> {{-- end col-md-4 --}}
            <div class="col-md-4"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>