<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ordervouncher;

class OrdervouncherController extends Controller
{
    public function allOrders(){
        $orders=ordervouncher::all();
        return view('admin.order.ordervouncher',compact('orders'));
    }

    public function orderChange($id){
        $order=ordervouncher::find($id);
        $order->status=!$order->status;
        $order->update();
        return redirect()->route('#allOrders');
    }
}
