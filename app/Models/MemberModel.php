<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    use HasFactory;
    protected $table = 'member' ;
    protected $fillable = [ 
        "email" , "username" , "account" , "password" , 
        "photo" , "mail_token" , "fb_id"
    ] ;
}
