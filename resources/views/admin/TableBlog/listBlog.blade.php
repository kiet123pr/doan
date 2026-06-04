@extends('master.master')
@section('section')
<div class="card-body">
    <h4 class="card-title">Blog Table</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">image</th>
                    <th>description</th>
                    <th>Delete</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newData as $key => $value)
                <tr role="row">
                    <td>{{ $value['id'] }}</td>
                    <td> {{$value['title'] }}</td>
                    <td> {{$value['image']}} </td>
                    <td>{!!$value['content']!!} </td>
                    <td><a href="{{ url('/deleteBlog/' . $value['id'])}}">Delete</a></td>
                    <td><a href="{{ url('/editBlog/' . $value['id'])}}">edit</a></td>
                </tr>'
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/addBlog')}}"><button id="button">Add blog</button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection