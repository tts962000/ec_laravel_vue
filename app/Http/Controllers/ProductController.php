<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\SubCat;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=Category::all();
        $subcats=SubCat::all();
        $tags=Tag::all();
        return view('admin.product.create',compact('category','subcats','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $file=$request->file('image');
        $file_name=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/images',$file_name);
        $product=new Product();
        $product->name=$request->name;
        $product->image=$file_name;
        $product->category_id=$request->category_id;
        $product->subcat_id=$request->subcat_id;
        $product->tag_id=$request->tag_id;
        $product->price=$request->price;
        $product->description=$request->description;
        if($product->save()){
            return redirect()->route('product.index');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $category=Category::all();
        $subcats=SubCat::all();
        $tags=Tag::all();
        return view('admin.product.edit',compact('product','category','subcats','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validate=$request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'subcat_id'=>'required',
            'tag_id'=>'required',
            'description'=>'required',
            'price'=>'required'
        ]);
        if($validate){
            $product=Product::find($id);
            if($request->hasFile('image')){
                $file=$request->file('image');
                $file_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/images',$file_name);
                $product->image=$file_name;
            }
            $product->name=$request->name;
            $product->category_id=$request->category_id;
            $product->subcat_id=$request->subcat_id;
            $product->tag_id=$request->tag_id;
            $product->description=$request->description;
            $product->price=$request->price;
            if($product->update()){
                return redirect()->route('product.index');
            }else
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
