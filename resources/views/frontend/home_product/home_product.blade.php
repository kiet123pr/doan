@extends('frontend.layout.app')
@section('section')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
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
    })
</script>