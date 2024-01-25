@extends('admin.layouts.master')
@section('title','Category Page')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <a class="btn btn-success my-2" href="{{route('category.subcat.create',$cat->id)}}">Create Food Category</a>
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
                  @foreach ($cat->subCats as $subcat)
                  <tr>
                    <th scope="row">{{$subcat->id}}</th>
                    <td scope="row">{{$subcat->name}}</td>
                    <td scope="row">
                        <img width="50" height="50" src="{{url('/images/'.$subcat->image)}}" alt="">
                    </td>
                    <td scope="row">
                        <a class="btn btn-primary my-2" href="{{route('subcat.edit',$subcat->id)}}">Edit</a>
                        <form class="d-inline" action="{{route('subcat.destroy',$subcat->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger my-2" type="submit">Delete</button>
                        </form>
                        {{-- <a href=""><i class="fa-solid fs-4 fa-list" style="color: #FFD43B;"></i></a> --}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection()
