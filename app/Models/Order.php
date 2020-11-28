<?php

namespace App\Models;

use App\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = 
    [
        'cart','user_id','total_price','order_number','total_qty','status'
    ];


    public function scopeStatus($qry)
    {
        return $qry->where('status','pending');
    }



    // RELATIONS

    // MANY TO MANY USER_ORDER
        public function user()
        {
            return $this->belongsTo(User::class);
        }


    // MANY TO MANY ORDER_PRODUCT
        public function productes()
        {
            return $this->belongsToMany(Product::class);
        }

    // public $timeStamps = false;
    
}
