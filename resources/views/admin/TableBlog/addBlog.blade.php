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
<form method="post" enctype="multipart/form-data">
    @csrf
    <p>title(*)</p>
    <input type="text" name="title" placeholder="title" />
    <p>image</p>
    <input type="file" name="image" />

    <p>content</p>
    <textarea type="text" name="content" id="editor1"></textarea>
    <button type="submit">Create Blog</button>
</form>
@endsection