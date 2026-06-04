<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #cart_items .cart_info .table.table-condensed.total-result {
            margin-bottom: 10px;
            margin-top: 35px;
            color: #696763
        }

        #cart_items .cart_info .table.table-condensed.total-result tr {
            border-bottom: 0
        }

        #cart_items .cart_info .table.table-condensed.total-result span {
            color: #FE980F;
            font-weight: 700;
            font-size: 16px
        }

        #cart_items .cart_info .table.table-condensed.total-result .shipping-cost {
            border-bottom: 1px solid #F7F7F0;
        }

        #cart_items .cart_info {
            border: 1px solid #E6E4DF;
            margin-bottom: 50px
        }

        #cart_items .cart_info .cart_menu {
            background: #FE980F;
            color: #fff;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            font-weight: normal;
        }

        #cart_items .cart_info .table.table-condensed thead tr {
            height: 51px;
        }

        #cart_items .cart_info .table.table-condensed tr {
            border-bottom: 1px solid#F7F7F0
        }

        #cart_items .cart_info .table.table-condensed tr:last-child {
            border-bottom: 0
        }

        .cart_info table tr td {
            border-top: 0 none;
            vertical-align: inherit;
            margin-right: 5px;
        }

        #cart_items .cart_info .image {
            padding-left: 30px;
        }

        #cart_items .cart_info .cart_description h4 {
            margin-bottom: 0
        }

        #cart_items .cart_info .cart_description h4 a {
            color: #363432;
            font-family: 'Roboto', sans-serif;
            font-size: 20px;
            font-weight: normal;
        }

        #cart_items .cart_info .cart_description p {
            color: #696763
        }

        #cart_items .cart_info .cart_price p {
            color: #696763;
            font-size: 18px
        }

        #cart_items .cart_info .cart_total_price {
            color: #FE980F;
            font-size: 24px;
        }

        .cart_product {
            display: block;
            /*  margin: 15px -70px 10px 25px;*/
        }

        .cart_quantity_input {
            color: #696763;
            float: left;
            font-size: 16px;
            text-align: center;
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>
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
                    <td class="cart_description">
                        <h4><a href="">{{$value['name']}}</a></h4>
                        <p>{{$value['id']}}</p>
                    </td>
                    <td class="cart_price">
                        <p>{{$value['price']}}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2">
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
    </div>
</body>

</html>