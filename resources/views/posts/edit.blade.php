@extends('layouts.app')

@section('title') Edie @endsection
@section('content')

<form method="POST" action="{{route('posts.update',$post->id)}}">
    @csrf {{--protect from security   --}}
    @method('PUT'){{--    put يعني الميثود update  وانا بدي اياه يعمل get & post لانه الفورم ما بوخذ غير --}}
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" value="{{$post->title}}" class="from-control">
    </div>
    <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{$post->description}}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select name="post_creator" class="form-control">
            @foreach($users as $user)
            {{-- <option @if($user->id == $post->user_id) selected @endif value="{{$user->id}}">{{$user->name}}</option> --}}
            <option @selected($post->user_id == $user->id) value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection