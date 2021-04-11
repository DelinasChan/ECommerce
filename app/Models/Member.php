<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $fillable = [
        'id', 'name', 'account', 'email', 'login_provider',
        'client_token', 'client_id', 'created_at', 'password',
    ];

    protected $hidden = [
        'client_token',
        'client_id',
        'login_provider',
        'password',
    ];

}
