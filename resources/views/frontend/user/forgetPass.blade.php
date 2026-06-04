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
        <h2> account</h2>
        <form method="post">
            @csrf
            <input type="text" name="email" placeholder="email" />
            <button type="submit">gửi</button>
        </form>
    </div>
</div>
@endsection