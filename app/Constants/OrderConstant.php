<?php

namespace App\Constants;

class OrderConstant{

    /**
     * 訂單處理狀態 
     * 
     * CANCEL    訂單取消
     * WAIT      等待付款
     * READY     處理完成
     * DEFAULT   預設 在購物車中
     * 
    */
    public static $SHOP_CANCEL = 'CANCEL';
    public static $SHOP_WAIT   = 'WAIT';
    public static $SHOP_READY  = 'READY';
    public static $SHOP_DEFAULT  = 'INCART';

    /**
     * 付款狀態
     *
     * PURCHASED 付款成功
     * FAILED    付款失敗
     *  error_message 錯誤代碼 會有訊息
     *  error_code    錯誤代碼
     * DEFAULT   預設 不需付款
     *
    */
    public static $PAYMENT_PURCHASED = 'PURCHASED';
    public static $PAYMENT_ERROR = 'ERROR';
    public static $PAYMENT_DEFAULT = 'NOTNEED';

}