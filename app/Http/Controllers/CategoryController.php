<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        // $tags=Tag::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags=Tag::all();
        return view('admin.category.create',compact('tags'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $file=$request->file('image');
        $file_name=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/images',$file_name);
        $category=new Category();
        $category->name=$request->name;
        $category->tag_id=$request->tag_id;
        $category->image=$file_name;
        if($category->save()){
            return redirect()->route('categories.index');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validate=$request->validate([
            'name'=>'required'
        ]);
        if($validate){
            $category=Category::find($id);
            $category->name=$request->name;
            if($request->hasFile('image')){
                $file=$request->file('image');
                $file_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/images',$file_name);
                $category->image=$file_name;
            }
            if($category->update()){
                return redirect()->route('categories.index');
            }else{
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
