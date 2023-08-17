<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessTokens extends Model
{
    use HasFactory;

    public $table = 'access_tokens';
    public $fillable = [ 'user_id', 'accessToken', 'expires_at'];
}
