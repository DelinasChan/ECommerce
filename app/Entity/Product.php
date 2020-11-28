<?php

namespace App\Entity ;

class Product {
    
    public $name = ""         ; 
    public $introduce = ""    ;
    public $attachments = []  ;
    public $discountPrice = 0 ;
    public $originalPrice = 0 ;


    public function __construct( $Product = null )
    {   
        if( $Product )
        {   
            $attachments = json_decode( $Product->attachments , false ) ;
            foreach( $attachments as $key => $attachment )
            {
                $attachment->value = json_encode( $attachment );
            };
            $this->id            = $Product->id   ;
            $this->name          = $Product->name ;
            $this->introduce     = $Product ->introduce ;
            $this->attachments   = $attachments ;
            $this->discountPrice = $Product->discountPrice ;
            $this->originalPrice = $Product->originalPrice ;
            $this->fold          = floor( $Product->discountPrice / $Product->originalPrice  * 100 ) ; //折扣數
            $this->image         = $attachments[0] ;//第 一張 圖片 當預覽圖
            $this->createdAt     = $Product->createdAt ;
        }

    }
}

