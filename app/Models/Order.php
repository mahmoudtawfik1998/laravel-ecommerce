<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status', 'customer_name', 'customer_phone', 'customer_address', 'notes'];

    public function user()
{
    return $this->belongsTo(User::class);
}
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
