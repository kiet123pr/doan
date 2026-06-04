@extends('master.master')
@section('section')
<div class="card-body">
    <h4 class="card-title">User Table</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th>phone</th>
                    <th>adress</th>
                    <th>avatar</th>
                    <th>level</th>
                    <th>delete</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                <tr role="row">
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td> {{$value['email'] }}</td>
                    <td> {{$value['phone']}} </td>
                    <td>{!!$value['address']!!} </td>
                    <td>{!!$value['avatar']!!} </td>
                    <td>{!!$value['level']!!} </td>
                    <td><a href="{{ route('admin.deletelistuser',$value['id'])}}">Delete</a></td>
                    <td><a href="{{ route('admin.editlistuser' ,$value['id'])}}">edit</a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>
@endsection