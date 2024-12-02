<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 商品情報を管理するモデル
 *
 * @package App\Models
 * @property int $id 商品ID
 * @property string $name 商品名
 * @property float $price 価格
 * @property string $description 商品説明
 * @property string $image 商品画像（ファイル名）
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereImage($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFactory;

    // テーブル名を指定（省略可能だが明示的に記載）
    protected $table = 'items'; 

    // マスアサインメント可能な属性を指定
    protected $fillable = ['name', 'price', 'description', 'image']; 

    // 画像ファイル名を格納するカラム 'image' を追加
}
