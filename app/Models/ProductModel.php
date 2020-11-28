<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "product" ;
    protected $fillable = [ "discountPrice" , "originalPrice" , "name" , "introduce" , "attachments" , "createdAt" , "memberId" , "productName" ] ;
    public $timestamps = false;

    /** 
     * thumbnail 縮圖
     * 反序列化 attachments 成物件 
     * @return Array<Image>
    */
    public function getthumbnailAttribute()
    {
        $attachments = json_decode( $this->attachments , false ) ;
        foreach( $attachments as $key => $attachment )
        {
            $attachment->value = json_encode( $attachment );
        };
        return $attachments ;
    }

    /** 
     * 
     * @return fold 折扣數 
    */
    public function getfoldAttribute()
    {
        return floor( $this->discountPrice / $this->originalPrice  * 100 ) ;
    }

    /** 
     * image 預覽圖片  
     * @return image
    */
    public function getimageAttribute()
    {
        $attachments = json_decode( $this->attachments , false ) ;
        return $attachments[0];
    }

    /** 
     * 分頁查詢產品 
     * @param boolean isPerson 判斷是否查個人商品
     * */
    public static function getProducts( $page , $isPerson = false , $perPage = 10 )
    {
        if( $isPerson ){
            //根據會員 Id 尋找相關產品
            $userId = session()->get("user")["id"] ;
            $paginator = ProductModel::where( "memberId" , "=" , $userId )->orderBy("createdAt" , "DESC")->paginate( $perPage , ["*"] , "page", $page );    
        }else{
            $paginator = ProductModel::orderBy("createdAt" , "DESC")->paginate( $perPage , ["*"] , "page" , $page );    
        };
        $data = $paginator->items() ;
        $cart = session()->get("cart") ;
        if( !$cart ) session()->put("cart",[]);
        foreach( $data as $Product )
        {
            $Product->inCart = isset ( $cart[ $Product->id ] );
        };

        return [ "lastPage" => $paginator->lastPage() , "data" => $data ] ;

    }

}

