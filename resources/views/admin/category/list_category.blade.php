@extends('master.master')
@section('section')
<div class="card-body">
    <h4 class="card-title">Category Table</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($newData as $key => $value)
                <tr role="row">
                    <td>{{ $value['id']}}</td>
                    <td>{{$value['category']}}</td>
                    <td><a href="{{ route('category.delete' , $value['id']) }}">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{route('category.add')}}"><button id="button">Add category</button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection