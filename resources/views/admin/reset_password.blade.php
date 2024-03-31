<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>

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

    <form action="{{ route('admin.resetPassword_submit') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="password" name="password" id="" placeholder="Enter new password">
        <input type="password" name="password_confirmation" id="" placeholder="Confirm password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>