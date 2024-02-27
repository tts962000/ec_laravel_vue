<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ordervouncher extends Model
{
    use HasFactory;
    protected $fillable=['user_id','qty','total','status'];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
