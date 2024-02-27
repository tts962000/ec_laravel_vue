<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ordervouncher;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function orderItemDetail($id)
    {
        // $orderItems=OrderItem::where('ordervouncher_id',$id)->get();
        $orderItems=OrderItem::select('order_items.*','ordervounchers.status as order_status')
                  ->leftjoin('ordervounchers','ordervounchers.id','order_items.ordervouncher_id')
                  ->where('order_items.ordervouncher_id',$id)->get();
        // $orderItems=ordervouncher::where('id',$id)->get()->load('orderItems');
        return view('admin.order.orderdetail',compact('orderItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
