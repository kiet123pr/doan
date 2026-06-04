@extends('frontend.layout.app')
@section('section')
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            @php
            $avatar = json_decode($data['avatar'],true);
            @endphp
            <img src="{{asset('upload/product/'.$avatar['0'])}}" alt="" />
            <a href="{{asset('upload/product/'.$avatar['0'])}}" rel="prettyPhoto">
                <h3>ZOOM</h3>
            </a>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @for($i = 0; $i < 3; $i++)
                    <div class="item {{ $i == 0 ? 'active' : '' }}">
                    @foreach($avatar as $key => $value)
                    <a href="">
                        <img src="{{ asset('upload/product/hinh50_'.$value) }}" alt="">
                    </a>
                    @endforeach
            </div>
            @endfor
        </div>
        <!-- Controls -->
        <a class="left item-control" href="#similar-product" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right item-control" href="#similar-product" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<div class="col-sm-7">
    <div class="product-information"><!--/product-information-->
        <img src="images/product-details/new.jpg" class="newarrival" alt="" />
        <h2>{{$data['name']}}</h2>
        <p>{{$data['id']}}</p>
        <img src="images/product-details/rating.png" alt="" />
        <span>
            <span>{{$data['price']}}</span>
            <label>Quantity:</label>
            <input type="text" value="3" />
            <button type="button" class="btn btn-fefault cart">
                <i class="fa fa-shopping-cart"></i>
                Add to cart
            </button>
        </span>
        <p><b>Availability:</b> In Stock</p>
        <p><b>Condition:</b> New</p>
        <p><b>Brand:</b> E-SHOPPER</p>
        <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
    </div><!--/product-information-->
</div>
</div><!--/product-details-->
<script>
    $(document).ready(function() {
        $("a[rel^='prettyPhoto']").prettyPhoto();
        $('.carousel-inner img').click(function(e) {
            e.preventDefault();
            var img = $(this).attr('src');
            var New_img = img.replace('hinh50_', '');
            console.log(New_img)
            $('.view-product img').attr('src', New_img);
            $('.view-product a').attr('href', New_img);
        });
    });
</script>
@endsection