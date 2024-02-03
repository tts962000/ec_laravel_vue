@extends('admin.layouts.master')
@section('title','Product Page')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <a class="btn btn-success my-2" href="{{route('product.create')}}">Create New Food</a>
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $item)
                  <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td scope="row">{{$item->name}}</td>
                    <td scope="row">
                        <img width="50" height="50" src="{{url('/images/'.$item->image)}}" alt="">
                    </td>
                    <td scope="row">{{$item->price}}</td>
                    <td scope="row">{{$item->description}}</td>
                    <td scope="row">
                        <a class="btn btn-primary my-2" href="{{route('product.edit',$item->id)}}">Edit</a>
                        <form class="d-inline" action="{{route('product.destroy',$item->id)}}" method="POST">
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
