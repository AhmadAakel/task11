@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="card mx-auto mt-5" style="max-width: 400px;">
    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Create User</h2>
        <<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstname">first name:</label>
                <input type="text" name="firstname" value="" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="lastname">last name:</label>
                <input type="text" name="lastname" value="" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="username">username:</label>
                <input type="text" name="username" value="" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Your Image</label>
                <input class="form-control" type="file" id="formFile" name = "image" >
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin"  id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Admin
                </label>
              </div>
    
            <button type="submit" class="btn btn-primary btn-block">Create</button>
        </form>
    </div>
</div>
@endsection