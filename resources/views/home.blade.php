@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
@if ( !$posts->count() )
There is no post till now. Login and write a new post now!!!
@else

<div class="">


  @foreach( $posts as $post )
  <div class="list-group" style="margin-bottom: 30px;">
    <div class="list-group-item">
      <div class="" >
        <h3><img src="{{ asset('images/'.$post->author->image) }}" alt="" title="" style="height: 40px;width: 40px;border-radius:100%;" class="mr-3" />{{ $post->title }}
          @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
          
          <button class="btn btn-warning text-white mr-2" style="float: right">

            <i class="fa fa-pencil" aria-hidden="true">  <a href="{{ url('edit/'.$post->slug)}}" class="text-white">Edit Post</a></i></button>

          <button class="btn btn-info mr-2" style="float: right"> <i class="fa fa-eye" aria-hidden="true">  <a href="{{ url('/user/'.$post->author_id)}}" class="text-white">View Post</a></i></button>

          @if($post->postCount<1)
           <button class="btn btn-danger mr-2" style="float: right">
             <i class="fa fa-trash" aria-hidden="true">  <a href="{{ url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="text-white">Delete Post </a></i>
            </button>
            @endif
           @endif
         </h3>
         <hr>
       </div>
       <img src="{{ asset('images/'.$post->image) }}" alt="" title="" height="300"  />

       <article>
        <a href='{{ url("show-description/".$post->id) }}'>{!! $post->body !!}</a>
      </article>

      <p>{{ $post->created_at->format('M d,Y') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
      <a href="{{ url('/'.$post->slug) }}">Comment<i style="font-size:24px" class="fa ml-2">&#xf0e6;</a></i><br>

      Total Comments {{@$post->postCount}}
    </div>

  </div>
  @endforeach
  {!! $posts->render() !!}
</div>
@endif
@endsection
