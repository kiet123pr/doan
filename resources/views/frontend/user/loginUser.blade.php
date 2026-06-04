@extends('frontend.layout.app')
@section('section')
@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="col-sm-4 col-sm-offset-1">
    <div class="login-form">
        <h2>Login to your account</h2>
        <form method="post">
            @csrf
            <input type="email" placeholder="Email Address" name="email"/>
            <input type="password" placeholder="password" name="password"/>
            <span>
                <input type="checkbox" class="checkbox">
                Keep me signed in
            </span>
            <a href="{{route('forgetpass.user')}}">quên mật khẩu</a>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
    </div>
</div>
@endsection