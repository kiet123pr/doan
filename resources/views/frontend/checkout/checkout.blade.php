@extends('frontend.layout.layout_cart')
@section('section')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        @if(!Auth::check())
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
        @endif
        <div class="review-payment">
            <h2>Review & Payment</h2>
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
                    $data = session()->get('cart')
                    @endphp
                    @foreach($data as $key => $value)
                    @php
                    $avatar = json_decode($value['avatar'],true);
                    $tong = $value['price'] * $value['qty']
                    @endphp
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('upload/product/hinh50_' .$avatar['0'])}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value['name']}}</a></h4>
                            <p>{{$value['id']}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{$value['price']}}</p>
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
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
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
                            <tr>
                                <td>Cart Sub Total</td>
                                <td>{{$total}}</td>
                            </tr>
                            <tr>
                                <td>Exo Tax</td>
                                <td>$2</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Shipping Cost</td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><span>{{$total1}}</span></td>
                            </tr>
                            @endif
                        </table>
                    </td>
                    </tr>
                </tbody>
            </table>
            <form method="post" action="{{ route('checkout.order') }}">
                @csrf
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Order</button>
                </div>
            </form>
        </div>
        <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div>

    </div>
</section> <!--/#cart_items-->
@endsection