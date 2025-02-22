<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInfo extends Model
{
    /** @use HasFactory<\Database\Factories\UserInfoFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }


}
