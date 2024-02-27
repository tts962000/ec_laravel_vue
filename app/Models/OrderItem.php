<?php

namespace App\Models;

use App\Models\ordervouncher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable=['user_id','tag_id','ordervouncher_id','category_id','subcat_id','name','image','price','qty','total'];

    public function orderVouncher(){
        return $this->belongsTo(ordervouncher::class);
    }

}
