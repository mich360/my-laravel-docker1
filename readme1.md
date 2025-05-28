# SQLiteを使用した  SQLiteはサーバーレスで動作する

## php artisan serve と npm run dev　　両方で起動する

課題はカート作成・詳細画面作成する


```code
起動

docker compose exec app php artisan tinker

App/Models/Item 書き込み

App\Models\Item::create([
    'name' => 'さつき',
    'price' => 4000,
    'image' => 'hana1.JPG',
    'description' => 'ツツジに比べ咲く時期が１ケ月早い',
]);

書き換え

$item = App\Models\Item::find(1);

$item->description = 'ツツジに比べ咲く時期が１ケ月遅い';

$item->save();

再起動
 npm run dev
```