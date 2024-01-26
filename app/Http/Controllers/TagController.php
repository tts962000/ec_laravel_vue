<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::all();
        return view('admin.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $file=$request->file('image');
        $file_name=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/images',$file_name);
        $tag=new Tag();
        $tag->name=$request->name;
        $tag->image=$file_name;
        if($tag->save()){
            return redirect()->route('tag.index');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag=Tag::find($id);
        return view('admin.tag.edit',compact('tag'));
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
            $tag=Tag::find($id);
            $tag->name=$request->name;
            if($request->hasFile('image')){
                $file=$request->file('image');
                $file_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/images',$file_name);
                $tag->image=$file_name;
            }
            if($tag->update()){
                return redirect()->route('tag.index');
            }else{
                return back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag=Tag::find($id);
        $tag->delete();
        return redirect()->route('tag.index');
    }
}
