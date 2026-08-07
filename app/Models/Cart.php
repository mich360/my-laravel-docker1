<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
    ];

    // 商品との関連
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // ユーザーとの関連
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}