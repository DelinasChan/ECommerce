<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "product" ;
    protected $fillable = [ "discountPrice" , "originalPrice" , "name" , "introduce" , "attachments" ] ;

    /** 
     * 根據ProductId 搜尋單一產品 
     * 將 attachments 反序列化成物件
    */
    public static function getProduct( $productId )
    {
        $Product = self::find( $productId );
        if( !isset( $Product ))return [] ;
        $Product["attachments"] = json_decode( $Product["attachments"] , false );
        return $Product ;
    }

}
