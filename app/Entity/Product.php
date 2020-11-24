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
            foreach( $attachments as $attachment )
            {
                $attachment->value = json_encode( $attachment );
            };
            $this->id            = $Product->id   ;
            $this->name          = $Product->name ;
            $this->introduce     = $Product ->introduce ;
            $this->attachments   = $attachments ;
            $this->discountPrice = $Product->discountPrice ;
            $this->originalPrice = $Product->originalPrice ;
        }

    }
}

