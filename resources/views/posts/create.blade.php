@extends('layouts.app')

@section('title') Create @endsection

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}} </li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{route('posts.store')}}">
    @csrf {{--protect from security   --}}
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="from-control" value="{{old('title')}}">
    </div>
    <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" >{{old('description')}}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select name="post_creator" class="form-control" >
            @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
                
            @endforeach
            {{-- <option value="1">Ahmed</option>
            <option value="2">Mohamed</option> --}}
        </select>
    </div>

    <button class="btn btn-success">Submit</button>
</form>

@endsection