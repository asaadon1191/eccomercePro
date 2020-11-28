<?php

namespace App\Api;

use App\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cartapi extends Model
{
    protected $table = "cartapis";

    protected $fillable = 
    [
        'user_id','product_id','total_price','qty','status'
    ];

    protected $hidden = 
    [
        'pivot'
    ];



    public function scopeStatus($qry)
    {
        return $qry->where('status','pending');
    }
    // RELATIONS

   // MANY TO MANY WITH PRODUCTS
        public function productes()
        {
            return $this->belongsToMany(Product::class);
        }

   // MANY TO MANY WITH USERS
        public function users()
        {
            return $this->belongsToMany(User::class);
        }
}
