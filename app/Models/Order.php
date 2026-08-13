<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'dokan_id',
        'total_amount',
        'status',
        "payment_method",
        "payment_status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokan()
    {
        return $this->belongsTo(Dokan::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
