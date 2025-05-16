@extends('layouts.app')
@section('title') Show
@endsection
@section('content')
        <div class="card mt-4" style="width: 40rem;">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
              <h5 class="card-title">Post Info</h5>
              <p class="card-text">Title: {{$post['title']}}</p>
              <p class="card-text">Description: {{$post['description']}}</p>
            </div>
          </div>
          <div class="card mt-4" style="width: 40rem;">
            <div class="card-header">
                Post Creator info
            </div>
            <div class="card-body">
              <h5 class="card-title">Name: {{$post->user ? $post->user->name : 'not found'}}</h5>
              <p class="card-text">Email: {{$post->user ? $post->user->email : 'not found'}}</p>
              <p class="card-text">Created At: {{$post->user ? $post->user->created_at : 'not found'}}</p>
            </div>
    @endsection