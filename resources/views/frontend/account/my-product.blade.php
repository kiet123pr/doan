@extends('frontend.layout.layout-account')
@section('section')
<div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
            <tr class="cart_menu">
                <td class="image">image</td>
                <td class="description">name</td>
                <td class="price">price</td>
                <td class="total">action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
            @php 
            $avatar = json_decode($value['avatar'],true);
            @endphp
            <tr>
                <td class="cart_product">
                    <a href=""><img src="{{asset('/upload/product/hinh50_'.$avatar['0'])}}" alt=""></a>
                </td>
                <td class="cart_description">
                    <h4><a href="">{{$value->name}}</a></h4>
                </td>
                <td class="cart_price">
                    <p>{{$value->price}}</p>
                </td>
                <td class="cart_total">
                    <a href="{{route('account.edit',$value['id'])}}">edit</a>
                    <a href="{{route('account.delete',$value['id'])}}">delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    <a href="{{route('account.add_product')}}"><button id="button">Add blog</button></a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection