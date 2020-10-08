@extends('layouts.app')

@section('content')
<div class="container">
<h1>{{$post->title}}</h1>
<br/>
<p>{{$post->body}}</p>
<small>Written on {{$post->created_at}}</small>
<hr>
@if (!Auth::guest())
    @if (Auth::user()->id == $post->user_id)  <div class="row m-1">
        <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary mr-5">Edit</a>
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'ml-5'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    </div>
@endif
@endif
</div>
@endsection