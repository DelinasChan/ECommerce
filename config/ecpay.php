<?php
return [
    'MerchantId' => env('ECPAY_MERCHANT_ID'),
    'HashKey' => env('ECPAY_HASH_KEY'),
    'HashIv' => env('ECPAY_HASH_IV'),
    'InvoiceHashKey' => env('ECPAY_INVOICE_HASH_KEY', ''),
    'InvoiceHashIv' => env('ECPAY_INVOICE_HASH_IV', ''),
    'SendForm' => env('ECPAY_SEND_FORM', "ecpay.sendForm"),
    "ReturnUrl" =>env('ECPAY_RETURN'),
    "OrderResultURL" => env("ECPAY_REDIRECT" )
];