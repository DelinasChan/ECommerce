<?php

    namespace App\Service ;

    use App\Models\ProductModel ;
    class DashboardService {

        /** 分查查詢產品 每次十筆資料 */
        public function getProducts( $page = 1 )
        {   
            //根據會員 Id 尋找相關產品
            $userId = session()->get("user")["id"] ;
            $paginator = ProductModel::where( "memberId" , "=" , $userId )->orderBy("createdAt" , "DESC")->paginate( 10 , "*" , $page );
            $prodcutData = $paginator->items();
            $lastPage    = $paginator->lastPage();
            $data = [] ;
            foreach( $prodcutData as $product )
            {
                array_push( $data , new \App\Entity\Product( $product ) );
            }

            return [ "data" => $data , "lastPage" => $lastPage ] ;

        }



    }

?>