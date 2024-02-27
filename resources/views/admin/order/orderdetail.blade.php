@extends('admin.layouts.master')
@section('title','Customer Order Details')
@section('content')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Customer name</th>
                <th scope="col">Image</th>
                <th scope="col">Amount</th>
                <th scope="col">Product Price</th>
                <th scope="col">Total Price</th>
                <th scope="col">Items Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td scope="row">{{Auth::user()->name}}</td>
                    <td scope="row"><img width="50" height="50" src="{{url('/images/'.$item->image)}}" alt=""></td>
                    <td scope="row">{{$item->qty}}</td>
                    <td scope="row">{{$item->price}}</td>
                    <td scope="row">{{$item->total}}</td>
                    <td scope="row">
                        @if ($item->order_status)
                    <button class="btn btn-success btn-sm">Paid</button>
                    @else
                    <button class="btn btn-danger btn-sm">Pending</button>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
