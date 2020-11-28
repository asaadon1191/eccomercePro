<?php

namespace App\Models;

use App\User;
use App\Api\Cartapi;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = 
    [
        'name','quantity','price','description','photo'
    ];



// RELATIONS

    // MANY TO MANY USER_PRODUCT
    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }


    // MANY TO MANY ORDER_PRODUCT
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // MANY TO MANY WITH CARTS API
    public function cartApis()
    {
        return $this->belongsToMany(Cartapi::class);
    }
}
