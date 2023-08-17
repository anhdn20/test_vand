<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public $table = 'stores';
    public $fillable = [ 'user_id', 'name', 'address'];

    public function getListByUser($user_id, $key,$page) {
        $perPage    = 5;
        $offset     = ($page - 1) * $perPage;

        return $this->select('id','name','address')
        ->where('user_id', $user_id)
        ->where('name','like', '%'.$key.'%')
        ->orderBy('name', 'DESC')
        ->limit($perPage)->offset($offset)->get();
    }

}
