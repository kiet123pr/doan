@extends('master.master')
@section('section')
    
    <table id="datatable" style="border: 1px solid">
    <thead>
        <tr role="row">
            <th>ID</th>
            <th>title</th>
            <th style="width: 10%;">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($newData as $key => $value) 
        <tr role="row">
            <td>{{ $value['id']}}</td>
            <td>{{$value['brand']}}</td>
            <td><a href="{{ route('brand.delete' , $value['id']) }}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8">
                <a href="{{route('brand.add')}}"><button id="button">Add brand</button></a>
            </td>
        </tr>
    </tfoot>
</table>
@endsection