<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "images",
        "tags",
        "price",
        "discount",
        "dokan_id"
    ];

    protected $casts = [
        "images" => "array",
        "tags" => "array"
    ];

    public function dokan()
    {
        return $this->belongsTo(Dokan::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
