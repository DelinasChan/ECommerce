<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Member extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected $table = 'member';
    protected $fillable = [
        'id', 'username', 'account', 'email', 'provider_name',
        'provider_token', 'provider_id', 'created_at', 'password',
        'email_token', 'is_enabled',
    ];

    protected $hidden = [
        'client_token',
        'client_id',
        'login_provider',
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes[$this->getAuthIdentifierName()];
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getRememberToken()
    {
        // 不使用 remember token，回傳空字串
        return '';
    }

    public function getRememberTokenName()
    {
        // 不使用 remember token，回傳空字串
        return '';
    }

}
