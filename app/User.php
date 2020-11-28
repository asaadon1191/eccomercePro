<?php

namespace App;

use App\Users\Cart;
use App\Api\Cartapi;
use App\Models\Order;
use App\Models\Product;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


// RELATIONS
    // MANY TO MANY WITH ORDERS
        public function orders()
        {
            return $this->belongsToMany(Order::class);
        }

    // MANY TO MANY WITH PRODUCTS
        public function products()
        {
            return $this->belongsToMany(Product::class);
        }


    // // MANY TO MANY WITH CARTS
    //     public function carts()
    //     {
    //         return $this->belongsToMany(Cart::class);
    //     }


    // MANY TO MANY WITH CART API
        public function cartsApi()
        {
            return $this->belongsToMany(Cartapi::class);
        }
}
