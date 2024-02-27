<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\SubCat;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ordervouncher;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function login(Request $request){
        $input=$request->only('email','password');
        $jwtToken=JWTAuth::attempt($input);
        if($jwtToken){
            return response()->json([
                'status'=>true,
                'msg'=>'success',
                'token'=>$jwtToken
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'fail'
            ]);
        }
    }
    public function check(){
        return response()->json([
            'msg'=>'success',
            'user'=>auth()->user()
        ]);
    }
    public function cats(){
        $data=Category::get()->load('subcats');
        return response()->json([
            'cats'=>$data
        ]);
    }
    public function subcats(){
        $data=SubCat::all();
        return response()->json([
            'subcats'=>$data
        ]);
    }
    public function products(){
        $data=Product::all();
        return response()->json([
            'products'=>$data
        ]);
    }
    public function tags(){
        $data=Tag::all();
        return response()->json([
            'tags'=>$data
        ]);
    }

    public function sbc($id){
        $data=SubCat::where('category_id',$id)->get();
        return response()->json([
            'sbc'=>$data
        ]);
    }

    public function pbc($id){
        $data=Product::where('category_id',$id)->get();
        return response()->json([
            'pbc'=>$data
        ]);
    }

    public function pbt($id){
        $data=Product::where('tag_id',$id)->get();
        return response()->json([
            'pbt'=>$data
        ]);
    }

    public function cbt($id){
        $data=Category::where('tag_id',$id)->get();
        return response()->json([
            'cbt'=>$data
        ]);
    }


    public function submitOrders(Request $request){
        $orders=$request->orders; //1
        // return response()->json([ //testing
        //     'orders'=>$orders,
        //     'msg'=>'Submitted',
        //     'count'=>count($orders)
        // ]);
        $orderId=$this->saveOrders($orders);
        foreach($orders as $order){
            $product=Product::find($order['id']);
            $orderItem=new OrderItem();
            $orderItem->user_id=auth()->user()->id;
            $orderItem->ordervouncher_id=$orderId;
            $orderItem->category_id=$product->category_id;
            $orderItem->subcat_id=$product->subcat_id;
            $orderItem->tag_id=$product->tag_id;
            $orderItem->name=$product->name;
            $orderItem->price=$product->price;
            $orderItem->image=$product->image;
            $orderItem->qty=$order['qty'];
            $orderItem->total=$product->price*$order['qty'];
            $orderItem->save();
        }
        return response()->json([ //testing
            'msg'=>'Submitted'
        ]);
    }

    public function saveOrders($orders){ //id takhu chin lo chin lo
        $order=new ordervouncher(); //2
        $total=0;
        foreach($orders as $item){
            $product=Product::find($item['id']);
            $total+=$product->price*$item['qty'];
        }
        $order->user_id=auth()->user()->id;
        $order->qty=count($orders);
        $order->status=false;
        $order->total=$total;
        $order->save();
        return $order->id;
    }

    public function viewOrders(){
        $orders=ordervouncher::where('user_id',auth()->user()->id)->get()->load('orderItems');
        return response()->json([
            'msg'=>'All Orders',
            'orders'=>$orders
        ]);
    }

    public function userOrderDetail($id){
        $orderDetails=OrderItem::where('ordervouncher_id',$id)->get();
        return response()->json([
            'msg'=>'All Orders',
            'user order details'=>$orderDetails
        ]);
    }

    public function userOrderVouncher($id){
       $orderDetail=ordervouncher::where('id',$id)->get()->load('orderItems');
       return response()->json([
            'msg'=>'User Order Details',
            'user order vouncher'=>$orderDetail
       ]);
    }

    public function userOrders(Request $request,$id){
        $userOrders=ordervouncher::where('id',$id)->get()->load('orderItems');
        return response()->json([
             'msg'=>'User Orders',
             'user order vouncher'=>$userOrders
        ]);
     }
}
