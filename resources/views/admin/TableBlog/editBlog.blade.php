@extends('master.master')
@section('section')
<form method="post">
    @csrf
    <input type="text" name="title" placeholder="content" value="{{$newData1['title']}}"/>
    <input type="file" name="image" value="{{$newData1['image']}}"/>
    <input type="text" name="content" placeholder="content" value="{{strip_tags($newData1['content'])}}"/>
    <button type="submit">edit</button>
</form>
@endsection