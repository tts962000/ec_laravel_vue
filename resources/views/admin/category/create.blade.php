@extends('admin.layouts.master')
@section('title','Category Create')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Create Shop</label>
                  <input type="text" name="name" class="form-control"  aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Select Image</label>
                    <input type="file" name="image" class="form-control"  aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Choose Food Type</label>
                    <select name="tag_id" id="">
                        @foreach ($tags as $tag)
                            <option value={{$tag->id}}>{{$tag->name}}</option>
                        @endforeach
                    </select>
                  </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
    </div>
@endsection()
