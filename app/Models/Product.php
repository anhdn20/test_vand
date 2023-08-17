<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';
    public $fillable = [ 'store_id', 'name', 'price','quantity'];

    public function getListByStore($user_id, $key,$page) {
        $perPage    = 4;
        $offset     = ($page - 1) * $perPage;

        return Store::select('p.id','p.name','p.price','p.quantity','stores.name as nameStore')
        ->where('stores.user_id', $user_id)
        ->leftJoin('products as p', 'p.store_id', '=', 'stores.id')
        ->where('p.name','like', '%'.$key.'%')
        ->orderBy('p.name', 'DESC')
        ->limit($perPage)->offset($offset)->get();
    }
}
