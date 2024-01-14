@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        <h1 class="my-4">Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-5">Create User</a>
        <a href="{{route('users.trash')}}" class="btn btn-info btn-sm mb-5">Blocked User</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">first name</th>
                <th scope="col">last name</th>
                <th scope="col">user name</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            @foreach ($users as $user)
            @if($user != auth()->user())
            <tbody class="table-group-divider">
              <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                @if($user->is_admin == true)
                <td>Admin</td>
                @else 
                <td>User</td>
                @endif
                <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                    style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-info btn-sm"
                        onclick="return confirm('Are you sure you want to block this post?')">Block</button>
                </form>
                  <form action="{{ route('users.Delete', $user->id) }}" method="POST"
                    style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form></td>
              </tr>
            </tbody>
            @endif
            @endforeach
          </table>
    </div>
@endsection