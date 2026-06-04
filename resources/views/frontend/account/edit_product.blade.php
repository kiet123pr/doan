@extends('frontend.layout.layout-account')
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
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{ session('success') }}
</div>
@endif
<div class="blog-post-area">
    <h2 class="title text-center">edit Product!</h2>
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Name" name="name" value="{{$data_product->name}}" />
            <input type="number" placeholder="price" name="price" value="{{$data_product->price}}" />
            <select name="id_category">
                @foreach($data_category as $key)
                <option value="{{ $key->id }}" {{ $key['id'] == $data_product['id_category'] ? 'selected' : '' }}>
                    {{$key['category']}}
                </option>
                @endforeach
            </select>
            <select name="id_brand" placeholder="vui lòng chọn brand">
                @foreach($data_brand as $key)
                <option value="{{$key->id}}" {{ $key['id'] == $data_product['id_brand'] ? 'selected' : '' }}>{{$key->brand}}</option>
                @endforeach
            </select>
            <select id="status" name="status">
                <option>chọn</option>
                <option value="0" {{$data_product['status'] == 0 ? 'selected' : ''}}>new</option>
                <option value="1" {{$data_product['status'] == 1 ? 'selected' : ''}}>sale</option>
            </select>
            <input type="text" name="sale" id="sale" placeholder="0" value="{{$data_product->sale}}" />
            <input type="text" name="company" placeholder="Company profile" value="{{$data_product->company}}" />
            <input type="file" id="files" name="image[]" multiple><br><br>
            @php
            $avatar = json_decode($data_product['avatar'],true);
            @endphp
            @foreach($avatar as $key => $value)
            <img src="{{ asset('upload/product/hinh50_' . $value) }}" />
            <input type="checkbox" name="hinhxoa[]" value="{{ $value }}">
            @endforeach
            <textarea placeholder="Detail"></textarea>
            <button type="submit" class="btn btn-default">Edit</button>
        </form>
    </div>
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