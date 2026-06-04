@extends('master.master')
@section('section')
<div class="card-body">
    <h4 class="card-title">Product Table</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">tên sản phẩm</th>
                    <th>price</th>
                    <th>avatar</th>
                    <th>delete</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                @php
                $image = json_decode($value['avatar'], true);
                @endphp
                <tr role="row">
                    <td>{{ $value['id'] }}</td>
                    <td> {{$value['name'] }}</td>
                    <td> {{$value['price']}} $ </td>
                    <td>
                        <img src="{{ asset('upload/product/hinh50_'.$image['0']) }}" width="100">
                    </td>
                    <td><a href="{{ route('admin.deletelistproduct',$value['id'])}}">Delete</a></td>
                    <td><a href="{{ route('admin.editlistproduct' ,$value['id'])}}">edit</a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>
@endsection