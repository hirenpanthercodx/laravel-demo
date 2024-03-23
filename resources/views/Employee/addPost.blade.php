@extends('Layouts.app')

<div class="card">
    <div class='d-flex my-3'>
        <div>
            <button class='btn btn-secondary' onclick="window.location.href='{{ url('employee') }}'">Back</button>
        </div>
        <div class='ml-3 d-flex align-items-center'>
            <h4 class='d-flex align-items-center mb-0'>{{($editPost ?? '') ? 'Update' : 'Create' }} Post</h4>
        </div>
    </div>
    <form method="post" action="{{ ($editPost ?? '') ? url('/update/post/'.($editPost->id ?? '')) : url('/create/post') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="inputGroupFile04">Upload Image</label>
            <input type="file" class="form-control" name="uploadfile" id="inputGroupFile04" accept=".jpg, .png, .jpeg">
            <img src="{{asset('storage/'. ($editPost->image ?? ''))}}" style="display: {{($editPost ?? '') ? 'block' : 'none'}}" />
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" rows="4" cols="50"> {{$editPost->description ?? ''}}</textarea> 
        </div>
        <input type="text" name="oldImage" value="{{$editPost->image ?? ''}}" hidden />
        <button type="submit" class="btn btn-success w-100" >{{($editPost ?? '') ? 'Update' : 'Create'}}</button>
    </form>
    @if (($editPost ?? '') && in_array('delete', json_decode(session('auth_user')->permisssion)))
        <button class="btn btn-danger" onclick="window.location.href='{{ url('delete/post/'. ($editPost->id ?? '')) }}'">Delete</button>
    @endif 
</div>