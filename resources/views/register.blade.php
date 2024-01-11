@extends('layouts.master')
@section('title','Register Page')
@section('content')
<form action="{{ route('register') }}" method="post">
    @csrf
    @error('terms')
    @enderror
    <div class="form-group">
        <label for="">User Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label for="">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter Password">
    </div>
    <div class="form-group">
        <label for="">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Name">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endsection
