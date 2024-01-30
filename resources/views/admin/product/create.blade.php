@extends('admin.layouts.master')
@section('title','Product Create Page')
@section('content')
    <h1 class="text-center text-info my-5">Create Products</h1>
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Shop Name</label>
                        <select name="category_id" id="category_id" onchange="catChange(event)">
                            @foreach ($category as $cat)
                                <option value={{$cat->id}}>
                                    {{$cat->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Food Category</label>
                        <select name="subcat_id" id="subcat_id">
                            {{-- @foreach ($subcats as $subcat)
                                <option value={{$subcat->id}}>
                                    {{$subcat->name}}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Food Tag</label>
                        <select name="tag_id" id="tag_id">
                            @foreach ($tags as $tag)
                                <option value={{$tag->id}}>
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Food Price</label>
                        <input type="integer" name="price">
                        @error('price')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="file" name="image">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Food Description</label>
                        <textarea name="description" type="text" id="" cols="20" rows="3"></textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                    </div>
                        <button type="submit" class="col-md-12 btn bg-success">Create Food Now</button>
                </div>
            </form>
        </div>
    </div>
@endsection()
@push('script')
    <script>
        let category="{{$category}}";
        // console.log(category); from php to JS
        category=category.replace(/&quot;/g,"\"");
        // console.log(category); inspect console &quot; to "" g=globally
        category=JSON.parse(category); //json format
        // console.log(category);

        let subcats="{{$subcats}}";
        subcats=subcats.replace(/&quot;/g,"\"");
        subcats=JSON.parse(subcats);

        let catChange=(e)=>{
            // console.log(e.target.value);
            let catId=e.target.value; //option value=cat->id
            filterSubcats(catId); //first
        }
        let filterSubcats=(id)=>{ //second id=catId
            let subs=subcats.filter((s)=>s.category_id==id)
            // console.log(subs);
            let str="";
            for (let sub of subs){
                str+=` <option value="${sub.id}">
                                    ${sub.name}
                                </option>`;
            }
            document.querySelector('#subcat_id').innerHTML=str;
        }
        filterSubcats(category[0].id);
    </script>
@endpush
