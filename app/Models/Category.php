<?php

namespace App\Models;

use App\Models\SubCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','image'];
    public function subCats(){
        return $this->hasMany(SubCat::class);
    }
}
