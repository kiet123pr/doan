@extends('master.master')
@section('section')
<h1>Create Blog</h1>
<form method="post">
    @csrf
    <p>title</p>
    <input type="text" name="name" placeholder="title" />
    <button type="submit">Add</button>
</form>
@endsection