
    @extends('layouts.app')
    @section('title') Index
    @endsection
    @section('content')
        <div class="text-center">
            <a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>
        </div>
        {{-- @dd($posts) //بنوقف تنفيذ باقي الكود --}}
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Product By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
              <tr>
                <td >{{$post->id}}</td>
                {{-- $post['id']:لانها اوبجيكتphp بقدر اعملها بلرفل بس ما بتزبط في  --}}
                <td>{{$post->title}}</td>
                <td>{{$post->user ? $post->user->name : 'not found'}}</td>
                <td>{{$post->created_at->format('y-m-d')}}</td>
                {{-- $post->created_at->addDays(25)->format('y-m-d') --}}
                <td>
                    <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                    <form style="display: inline" method="POST" action="{{route('posts.destroy',$post['id'])}}">
                      @csrf
                      @method('DELETE')
                    <button type="submit"  class="btn btn-danger" >Delete</button>{{--href="{{route('posts.destroy',$post['id'])}}"--}}
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

@endsection
    