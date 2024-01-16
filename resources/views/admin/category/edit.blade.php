@extends('admin.layouts.master')
@section('title','Category Edit')
@section('content')
    <div class="container">
        <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Create Category</label>
              <input type="text" name="name" value="{{old('name',$category->name)}}" class="form-control"  aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
               <p>Current Image=></p>
               <img width="50" height="50" src="{{url('/images/'.$category->image)}}" alt="">
                <input type="file" name="image" class="form-control"  aria-describedby="emailHelp">
              </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
    </div>
@endsection()
