<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;
    protected $table = 'orderItem' ;
    protected $fillable = [ 
        "orderId" , "productId" , "price" , "quant" , 
    ] ;
}
