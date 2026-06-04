@extends('frontend.layout.app')
@section('section')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    <form method="get" action="{{route('home.searchAdvanced')}}">
        @csrf
        <div class="row">
            <div class="col-sm-3">
                <input type="text" name="search" placeholder="Name">
            </div>
            <div class="col-sm-2">
                <select name="price">
                    <option value="">Choose price</option>
                    <option value="0-1000">Dưới 1000</option>
                    <option value="1000-2000">1000 - 2000</option>
                    <option value="3000-50000"> > 2000</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="category">
                    <option value="">Category</option>
                    @foreach($category as $key)
                    <option value="{{$key['id']}}">
                        {{$key['category']}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select name="brand">
                    <option value="">Brand</option>
                    @foreach($brand as $key)
                    <option value="{{$key['id']}}">
                        {{$key['brand']}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select name="status">
                    <option value="">Status</option>
                    <option value="0">New</option>
                    <option value="1">Sale</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-warning">
            Search
        </button>
    </form>
    <div id="product-search">
        @foreach($data as $key => $value)
        @php
        $avatar = json_decode($value['avatar'],true);
        @endphp
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{asset('upload/product/' .$avatar['0'])}}" alt="" />
                        <h2>{{$value['price']}}$</h2>
                        <p>{{$value['name']}}</p>
                        <a href="#" class="btn btn-default add-to-cart" id="{{$value['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{$value['price']}}</h2>
                            <p>{{$value['name']}}</p>
                            <a href="#" class="btn btn-default add-to-cart" id="{{$value['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{route('product.detail', $value['id'])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div><!--features_items-->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-default').click(function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                type: 'post',
                url: '{{url("/home/product/ajax")}}',
                data: {
                    id: id,
                },
                success: function(data) {
                    const newData = data.session;
                    let s = 0;
                    Object.keys(newData).map(function(key, index) {
                        s = s + newData[key]['qty'];
                    })
                    console.log(s)
                    $('.cart_header').text(s);
                },
            })
        })
        $('#sl2').on('slideStop', function(e) {
            // thả tay ra mới lấy value
            var min = parseInt(e.value[0]);
            var max = parseInt(e.value[1]);
            console.log(min);
            console.log(max);
            $.ajax({
                type: 'post',
                url: "{{url('/home/ajax/searchAdvanced')}}",
                data: {
                    min: min,
                    max: max,
                },
                success: function(data) {
                    const newData = data.data.data
                    console.log(newData);
                    let html = ""
                    newData.map(function(value, key) {
                        const image = JSON.parse(value['avatar']);
                        html +=
                            '<div class="col-sm-4">' +
                            '<div class="product-image-wrapper">' +
                            '<div class="single-products">' +
                            '<div class="productinfo text-center">' +
                            '<img src="/upload/product/' + image['0'] + '" alt="" />' +
                            "<h2>" + value['price'] + "$" + "</h2>" +
                            "<p>" + value['name'] + "</p>" +
                            '<a href="#" class="btn btn-default add-to-cart" id="' + value['id'] + '">' + '<i class="fa fa-shopping-cart">' + " </i>" + "Add to cart" + "</a>" +
                            "</div>" +
                            '<div class="product-overlay">' +
                            '<div class="overlay-content">' +
                            "<h2>" + value['price'] + "</h2>" +
                            "<p>" + value['name'] + "</p>" +
                            '<a href="#" class="btn btn-default add-to-cart" id="' + value['id'] + '">' + '<i class="fa fa-shopping-cart">' + "</i>" + "Add to cart" + "</a>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            '<div class="choose">' +
                            '<ul class="nav nav-pills nav-justified">' +
                            "<li>" + '<a href="#">' + '<i class="fa fa-plus-square">' + "</i>" + "Add to wishlist" + "</a>" + "</li>" +
                            "<li>" + '<a href="#">' + '<i class="fa fa-plus-square">' + "</i>" + "Add to compare" + "</a>" + "</li>" +
                            "</ul>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                    })
                    console.log(html);
                    $('#product-search').html(html);
                }
            })
        });
    })
</script>