@extends('admin.layouts.master')
@section('title','Category Page')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <a class="btn btn-success my-2" href="{{route('categories.create')}}">Create New Category</a>
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $item)
                  <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td scope="row">{{$item->name}}</td>
                    <td scope="row">
                        <img width="50" height="50" src="{{url('/images/'.$item->image)}}" alt="">
                    </td>
                    <td scope="row">
                        <a class="btn btn-primary my-2" href="{{route('categories.edit',$item->id)}}">Edit</a>
                        <form class="d-inline" action="{{route('categories.destroy',$item->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger my-2" type="submit">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection()
