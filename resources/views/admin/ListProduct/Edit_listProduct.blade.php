@extends('master.master')
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
<div class="product-form">
    <h2>Edit Product</h2>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row-flex">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$data_product->name}}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" name="price" value="{{$data_product->price}}">
            </div>
        </div>
        <div class="row-flex">
            <div class="form-group">
                <label>Category</label>
                <select name="id_category" class="form-control">
                    @foreach($data_category as $key)
                    <option value="{{ $key->id }}"
                        {{ $key['id'] == $data_product['id_category'] ? 'selected' : '' }}>
                        {{$key['category']}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Brand</label>
                <select name="id_brand" class="form-control">
                    @foreach($data_brand as $key)
                    <option value="{{$key->id}}"
                        {{ $key['id'] == $data_product['id_brand'] ? 'selected' : '' }}>
                        {{$key->brand}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row-flex">
            <div class="form-group">
                <label>Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="0" {{$data_product['status'] == 0 ? 'selected' : ''}}> New</option>
                    <option value="1" {{$data_product['status'] == 1 ? 'selected' : ''}}>Sale</option>
                </select>
            </div>
            <div class="form-group" id="sale-box">
                <label>Sale %</label>
                <input type="text" class="form-control" name="sale" id="sale" value="{{$data_product->sale}}">
            </div>
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text" class="form-control" name="company" value="{{$data_product->company}}">
        </div>
        <div class="form-group">
            <label>Upload Image</label>
            <input type="file" class="form-control" name="image[]" multiple>
        </div>
        @php
        $avatar = json_decode($data_product['avatar'], true);
        @endphp
        <div class="image-preview">
            @foreach($avatar as $value)
            <div class="image-box">
                <img src="{{ asset('upload/product/hinh50_' . $value) }}">
                <div>
                    <input type="checkbox" name="hinhxoa[]" value="{{ $value }}">
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-group">
            <label>Detail</label>
            <textarea class="form-control" name="detail">{{$data_product->detail}}</textarea>
        </div>
        <button type="submit" class="btn-submit">Edit Product</button>
    </form>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sale-box').hide();
        $('#status').click(function() {
            var value = $(this).val();
            if (value == "1") {
                $('#sale-box').show();
            } else {
                $('#sale-box').hide();
            }
        })
    })
</script>