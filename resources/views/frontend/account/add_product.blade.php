@extends('frontend.layout.layout-account')
@section('section')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{ session('success') }}
</div>
@endif
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
<div class="blog-post-area">
    <h2 class="title text-center">Create Product!</h2>
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Name" name="name" />
            <input type="number" placeholder="price" name="price" />
            <select name="id_category">
                @foreach($data_category as $key)
                <option value="{{ $key['id'] }}">
                    {{$key['category']}}
                </option>
                @endforeach
            </select>
            <select name="id_brand" placeholder="vui lòng chọn brand">
                @foreach($data_brand as $key)
                <option value="{{$key['id']}}">{{$key['brand']}}</option>
                @endforeach
            </select>
            <select id="status" name="status">
                <option>chọn</option>
                <option value="0">new</option>
                <option value="1">sale</option>
            </select>
            <input type="text" name="sale" id="sale" placeholder="0" value="0"/>
            <input type="text" name="company" placeholder="Company profile" />
            <input type="file" id="files" name="avatar[]" multiple><br><br>
            <textarea placeholder="Detail"></textarea>
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div>
    @endsection
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sale').hide();
            $('#status').click(function() {
                var value = $(this).val();
                if (value == "1") {
                    $('#sale').show();
                } else {
                    $('#sale').hide();
                }
            })
        })
    </script>