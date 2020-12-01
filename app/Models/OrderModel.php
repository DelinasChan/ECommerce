<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'order' ;
    public $timestamps = false ;
    protected $casts = ['id' => 'string'];
    protected $fillable = [ 
        "id" , "memberId" , "payStatus" , "ecPay_tradeNo" , "createdAt" , 
    ] ;
    
    public function member()
    {
        return $this->hasone("App\Models\MemberModel" , "id" , "memberId" );
    }

    /**
     * @return Array<Item>
     */
    public function orderItem()
    {
        return $this->hasMany( 'App\Models\OrderItemModel' , "orderId" , "id" );
    }

    /** 查詢歷史訂單 */
    static function readOrders( $page = 1 )
    {
        //用戶Id 查詢訂單
        $userId = session()->get("user")["id"] ;
        $paginateor = OrderModel::where( "memberId" , "=" , $userId )->orderBy("createdAt" , "DESC")->paginate( 10 , ["*"] , "page" , $page );

        $data = $paginateor->items();
        $payStr = ["WAIT"=>"等待付款" , "SUCCESS"=>"成功" , "FAILED" => "失敗"] ;
        foreach( $data as $order )
        {
            $order->payResult = $payStr[ $order->payStatus ];
            $order->item = $order->orderItem ;
            foreach( $order->orderItem as $item  )
            {
                $item->product = $item->product ;
            }
        };
        

        return [ "lastPage" => $paginateor->lastPage() , "data" => $paginateor->items() ];
    }

}
