@extends('layouts.master')
@section('title','Login Page')
@section('content')
<form action="{{route('login')}}" method="post">
    @csrf
    @error('terms')
    @enderror
    <div class="form-group">
      <label class="text-danger"  for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <small>Email-admin@gmail.com/Pw-admin123</small>
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Sign In</button>
  </form>
  <a href="{{route('auth#registerPage')}}">Register</a>
@endsection
