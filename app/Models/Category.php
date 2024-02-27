<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\SubCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['tag_id','name','image'];
    public function subCats(){
        return $this->hasMany(SubCat::class);
    }

    public function tags(){
        return $this->belongsTo(Tag::class,'tag_id');
    }

}
