<?php

use Aws\S3\S3Client ;

use Illuminate\Support\Facades\Log ;
use App\Models\MediaModel;

class AWSClient{

    public static function uploadS3( $file , $path )
    {
        if( !$file || ! $path ) return false ; 
        $fileName =  time() . "-" . $file->getClientOriginalName() ;
        $key = $path.$fileName ;
        $putData = [ "key" => $key , "Body" => file_get_contents( $file ) ];
        return ( new AWSS3() )->upload( $putData ) ;
    }    
    

}


class AWSS3{

    public function __construct()
    {
        $this->s3 = new S3Client([
            "version" => config("aws.version"),
            'region'  => config("aws.region"),
            'scheme'  => 'http'    
        ]);
    }

    public function upload( $putData , $ACL = "public-read" )
    {
        $result = $this->s3->putObject([
            'Bucket' => config("aws.bucket"),
            'Key'    => $putData["key"]     ,
            'Body'   => $putData["Body"]    ,
            'ACL' => $ACL
        ]);

        return new AWSResult(  $result ) ;
    }

};

class AWSResult {
    
    public function __construct( $result )
    {
        $this->result = $result ;
    }

    /** 取得物件 Url */
    public function getObjectUrl()
    {
        return $this->result["ObjectURL"] ;
    }

    public function getResut()
    {
        return $this->result ;
    }

    public function saveToDB()
    {
        $src = $this->result["ObjectURL"] ;
        
        $explodeSrc = explode( "/" , $src ) ;
        $name =  $explodeSrc[ count( $explodeSrc ) -1 ] ;
        $insertMedia = [ "src" => $src , "name" =>$name ] ;
        $Media = MediaModel::create( [ "src" => $src , "name" =>$name ] );
        return [ "src" => $src , "name" =>$name  , "id" => $Media->id ];

    }

}