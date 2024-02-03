<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\SubCat;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
}
