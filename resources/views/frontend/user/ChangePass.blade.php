@extends('frontend.layout.app')
@section('section')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
    {{ session('error') }}
</div>
@endif
<div class="col-sm-4 col-sm-offset-1">
    <div class="login-form">
        <h2>Resert Password</h2>
        <form method="post">
            @csrf
            <input name="email" type="hidden" value="{{$email}}" />
            <input name="id" type="hidden" value="{{$id}}" />
            <input name="password" type="password" placeholder="vui lòng nhập mật khẩu" />
            <input type="password" name="confirm_password" placeholder="vui lòng nhập lại mật khẩu" />
            <button type="submit">gửi</button>
        </form>
    </div>
</div>
@endsection