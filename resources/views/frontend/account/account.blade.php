@extends('frontend.layout.layout-account')
@section('section')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{ session('success') }}
</div>
@endif
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Update user</h2>
        <div class="signup-form"><!--sign up form-->
            <h2>New User Signup!</h2>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Name" value="{{$data_user['name']}}" />
                <input type="email" name="email" placeholder="Email Address" value="{{$data_user['email']}}" readonly />
                <input type="password" name="password" placeholder="Password" />
                <input type="text" name="phone" placeholder="phone" value="{{$data_user['phone']}}" />
                <select name="address">
                    @foreach ($data_country as $key)
                    <option>{{$key['name']}}</option>
                    @endforeach
                </select>
                <input type="file" name="avatar" />
                <button type="submit" class="btn btn-default">update</button>
            </form>
        </div>
    </div>
</div>
@endsection