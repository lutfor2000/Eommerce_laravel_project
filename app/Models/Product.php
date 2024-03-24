<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    // protected $fillable = [
    //     'category_id',
    //     'product_name',
    //     'product_price',
    //     'product_quantity',
    //     'product_short_disc',
    //     'product_long_disc',
    //     'product_alert_quantity',
    // ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    // public function users(){
    //     return $this->belongsTo(User::class);
    // }
}
