<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    function producttoorderdreletion(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
