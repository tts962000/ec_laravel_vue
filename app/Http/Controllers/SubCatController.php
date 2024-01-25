<?php

namespace App\Http\Controllers;

use App\Models\SubCat;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;

class SubCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $cat=Category::find($id)->load(['subCats']);
        return view('admin.subcat.index',compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $cat=Category::find($id);
        return view('admin.subcat.create',compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request,$id)
    {
        $file=$request->file('image');
        $file_name=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/images',$file_name);
        $subcat=new SubCat();
        $subcat->name=$request->name;
        $subcat->image=$file_name;
        $subcat->category_id=$id;
        if($subcat->save()){
            return redirect()->route('category.subcat.index',$id);
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCat $subCat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCat $subCat,$id)
    {
        //Parent->id find with same child ids
        //shallow on resource
        $subcat=SubCat::find($id);
        return view('admin.subcat.edit',compact('subcat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate=$request->validate([
            'name'=>'required'
        ]);
        if($validate){
            $subcat=SubCat::find($id);
            $subcat->name=$request->name;
            if($request->hasFile('image')){
                $file=$request->file('image');
                $file_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/images',$file_name);
                $subcat->image=$file_name;
            }
            if($subcat->save()){
                return redirect()->route('category.subcat.index',$subcat->category_id);
            }else{
                return back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCat $subCat,$id)
    {
        $subcat=SubCat::find($id);
        $subcat->delete();
        return redirect()->route('category.subcat.index',$subcat->category_id);
    }
}
