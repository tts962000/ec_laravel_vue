@extends('admin.layouts.master')
@section('title','Customer Order Vounchers')
@section('content')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Customer name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Net Amount</th>
                <th scope="col">Action</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($orders as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td scope="row">{{Auth::user()->name}}</td>
                    <td scope="row">{{$item->qty}}</td>
                    <td scope="row">{{$item->total}}</td>
                   <td> <a class="btn btn-primary" href="{{route('#orderItemDetail',$item->id)}}"><i class="fa-solid fa-eye"></i></a></td>
                   <td scope="row">
                    <form action="{{route('#orderChange',$item->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        {{-- <button class="btn @if ($item->status) btn-success
                        @else
                            btn-danger
                        @endif btn-sm" type="submit">Change</button> --}}
                        @if ($item->status)
                            <button class="btn btn-success btn-sm">Paid</button>
                        @else
                        <button class="btn btn-danger btn-sm">Pending</button>
                        @endif
                    </form>
                   </td>
                </tr>
                @endforeach

            </tbody>
          </table>
    </div>
</div>
@endsection
