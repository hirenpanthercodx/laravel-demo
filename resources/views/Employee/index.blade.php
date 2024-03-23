@extends('Layouts.app')

<div class="card">
    <div class='d-flex justify-content-between my-3'>
        <h4 class='d-flex align-items-center mb-0'>Employee Post</h4>
        <div class='d-flex'>
            <div class='mr-2'>
                <button class='btn btn-success' onClick="window.location.href='{{ url("/employee/addPost") }}'">
                    Add Post
            </button>
            </div>
            <div>
                <button class='btn btn-danger' onClick="window.location.href='{{ url("/logout") }}'">Logout</button>
            </div>
        </div>
    </div>
    @foreach ($postByUser as $item)
        <div class='card'>
            <a href="{{ url("/employee/edit/$item->id") }}">
                <img src={{asset('storage/'. $item->image)}}  />
                <p style='color:black'>{{$item->description}}</p>
            </a>
        </div>
    @endforeach
</div>