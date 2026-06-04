@extends('master.master')
@section('section')
<div class="card-body">
    <h4 class="card-title">History Table</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th>name</th>
                    <th>price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                <tr role="row">
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['email'] }}</td>
                    <td> {{$value['phone'] }}</td>
                    <td> {{$value['name']}} </td>
                    <td>  ${{$value['price']}} </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>
@endsection