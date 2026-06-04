@extends('frontend.layout.layout_cart')
@section('section')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if(session()->has('cart'))
                    @php
                    $data = session()->get('cart');
                    @endphp
                    @foreach($data as $key => $value)
                    @php
                    $tong = $value['price'] * $value['qty'];
                    $avatar = json_decode($value['avatar'], true);
                    @endphp
                    <tr id="{{$value['id']}}">
                        <td class="cart_product">
                            <a href=""><img src="{{asset('upload/product/hinh50_'. $avatar['0'])}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value['name']}}</a></h4>
                            <p>{{$value['id']}}</p>
                        </td>
                        <td class="cart_price">
                            <p class="price">{{$value['price']}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$tong}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    @if(session()->has('cart'))
                    @php
                    $data = session()->get('cart');
                    $total = 0;
                    foreach ($data as $key => $value) {
                    $new_total = $value['qty'] * $value['price'];
                    $total = $total + $new_total;
                    }
                    $total1 = $total + 2;
                    @endphp
                    <ul>
                        <li>Cart Sub Total <span class="total">${{$total}}</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span class="total1">${{$total1}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
<script>
    $(document).ready(function() {
        $('.cart_quantity_down').click(function(e) {
            e.preventDefault();
            var value = $(this).closest('.cart_quantity_button').find('.cart_quantity_input').val();
            var id = $(this).closest('tr').attr('id');
            var price = $(this).closest('tr').find('.price').text();
            console.log(price);
            console.log(id);
            if (value > 1) {
                var qty = value - 1;
                var tong = qty * price;
                $(this).closest('.cart_quantity_button').find('.cart_quantity_input').val(qty);
                $(this).closest('tr').find('.cart_total_price').text(tong);
                var s = 0;
                $('.cart_total_price').each(function() {
                    var cart_total = $(this).text();
                    s += parseInt(cart_total)
                });
                console.log(s)
                $('.total').text(s);
                var s1 = s + 2;
                $('.total1').text(s1);
                $.ajax({
                    type: 'post',
                    url: '{{url("/cart/ajax")}}',
                    data: {
                        id_down: id
                    },
                    success: function(data) {
                        console.log(data);
                    }
                })
            } else {
                alert("không thể xóa tiếp")
            }

        })

        $('.cart_quantity_up').click(function(e) {
            e.preventDefault();
            var value = $(this).closest('.cart_quantity_button').find('.cart_quantity_input').val();
            console.log(value)
            var newValue = parseInt(value);
            var qty = newValue + 1;
            $(this).closest('.cart_quantity_button').find('.cart_quantity_input').val(qty);
            var id = $(this).closest('tr').attr('id');
            var price = $(this).closest('tr').find('.price').text();
            var tong = qty * price;
            $(this).closest('tr').find('.cart_total_price').text(tong);
            var s = 0;
            $('.cart_total_price').each(function() {
                var cart_total = $(this).text();
                s += parseInt(cart_total)
            });
            console.log(s)
            var s1 = s + 2;
            $('.total').text(s);
            $('.total1').text(s1);
            $.ajax({
                type: 'post',
                url: '{{url("/cart/ajax")}}',
                data: {
                    id_up: id
                },
                success: function(data) {
                    console.log(data);
                }
            })
        })

        $('.cart_quantity_delete').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('tr').attr('id');
            $(this).closest('tr').remove();
            var s = 0;
            $('.cart_total_price').each(function() {
                var cart_total = $(this).text();
                s += parseInt(cart_total)
            });
            console.log(s)
            var s1 = s + 2;
            $('.total').text(s);
            $('.total1').text(s1);
            $.ajax({
                type: 'post',
                url: '{{url("/cart/ajax")}}',
                data: {
                    id_delete: id
                },
                success: function(data) {
                    console.log(data);
                }
            })
        })
    })
</script>
@endsection