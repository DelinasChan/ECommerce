<?php

namespace App\Constants;

class OrderConstant
{
    //訂單狀態: 建立成功
    const STATE_SUCCESS = 'SUCCESS';
    //訂單狀態: 建立失敗
    const STATE_FAILED = 'FAILED';
    //訂單狀態: 待付款
    const STATE_PENDING_PAYMENT = 'PENDING PAYMENT';

    //付款狀態: 付款失敗
    const PAY_FAILED = 'FAILED';
    //付款狀態: 處理中
    const PAY_PROCESS = 'PROCESS';
    //付款狀態: 成功
    const PAY_SUCCESS = 'SUSCCESS';

}
