@extends('layouts.app')

@section('title', 'Blocked Users')

@section('content')
    <div class="container">
        <h1 class="my-4">Blocked Users</h1>
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm mb-5">Users</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">first name</th>
                <th scope="col">last name</th>
                <th scope="col">user name</th>
                <th scope="col">email</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            @foreach ($trashedUsers as $user)
            <tbody class="table-group-divider">
              <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td> <form action="{{ route('users.restore', $user->id) }}" method="POST"
                    style="display:inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm">Unblock</button>
                </form>
                  <form action="{{ route('users.forceDelete', $user->id) }}" method="POST"
                    style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form></td>
              </tr>
            </tbody>
            @endforeach
          </table>
    </div>
@endsection