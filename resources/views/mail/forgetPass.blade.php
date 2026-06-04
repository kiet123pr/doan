<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Reset Password</h2>
    <p>email là :{{$data['email']}}</p>
    <p>yêu cầu thay đổi mật khẩu</p>
    <p>click vào link sau :</p>
    <a href="{{ route('changepass.user',$data['id']) }}">Reset Password</a>
</body>

</html>