@extends('layouts.app')

@section('content')
<div class="container p-2">
    <h1>Here are the latest post</h1>
    @if(count($posts) > 0)
@foreach ($posts as $post)
        <div class="box bg-white mt-4 rounded p-2 border" style="height: 220px">
            <div class="p-4">
               
                <h2><a  class="text-decoration-none text-muted" href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                <p class="text-decoration-none text-muted">{{$post->body}}</p>
                <small>Written on {{$post->created_at}}</small> 
                
        
        </div></div>
    @endforeach
    {{$posts->links()}}
    @else
    <h2>No Post was Uploaded</h2>
    @endif
</div>
@endsection