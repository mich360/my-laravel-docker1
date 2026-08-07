<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price'
    ];

    // 注文との関連
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 商品(Item)との関連
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}