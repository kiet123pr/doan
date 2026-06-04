@extends('master.master')
@section('section')
@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<h1>Create brand</h1>
<form method=post>
    @csrf
    <input type="text" name="brand" placeholder="brand"/>
    <button type="submit">create</button>
</form>
@endsection