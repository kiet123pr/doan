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
<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Name" name="name" />
            <input type="email" placeholder="Email Address" name="email" />
            <input type="password" placeholder="Password" name="password" />
            <input type="tel" placeholder="sdt" name="phone" />
            <input type="file" name="avatar" />
            <input type="text" name="address" placeholder="country" />
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div><!--/sign up form-->
</div>
@endsection