@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm mb-5">Create Post</a>
<a href="{{route('posts.trash')}}" class="btn btn-info btn-sm mb-5">Archived Posts</a>
    <div class="container">
        <h1 class="my-4">Posts</h1>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($post->image)
                            <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <div class="mt-2">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if (auth()->check() &&
                                auth()->user()->can('update', $post))
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endif
                                @if (auth()->check() &&
                                        auth()->user()->is_admin)
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-info btn-sm"
                                        onclick="return confirm('Are you sure you want to archive this post?')">Add To Archive</button>
                                </form>
                                @endif
                                @if (auth()->check() &&
                                        auth()->user()->can('delete', $post))
                                    <form action="{{ route('posts.Delete', $post->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>no posts</h2>
            @endforelse
        </div>
    </div>
@endsection
