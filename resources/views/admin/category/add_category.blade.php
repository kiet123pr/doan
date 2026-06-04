@extends('master.master')
@section('section')
<h1>create category</h1>
<form method="post">
    @csrf
    <input type="text" name="category" placeholder="category"/>
    <button type="submit">create</button>
</form>
@endsection