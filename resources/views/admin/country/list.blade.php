@extends('master.master')
@section('section')
<div class="card-body">
    <h4 class="card-title">Country Table</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($newData as $key => $value)
                <tr role="row">
                    <td>{{ $value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td><a href="{{ url('/delete/' . $value['id']) }}">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/add')}}"><button id="button">Add country</button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
