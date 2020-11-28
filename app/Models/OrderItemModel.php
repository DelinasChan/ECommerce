<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;
    protected $table = 'orderItem' ;
    public $timestamps = false;
    protected $fillable = [ 
        "id" , "orderId" , "productId" , "price" , "quant" , 
    ] ;

    /**
     *@return Object product
    */
    public function product()
    {
        return $this->hasOne( "App\Models\ProductModel" , "id" , "productId" ) ;
    }
}
