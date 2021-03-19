<?php

namespace App\Constants;

class RoleConstant{
    
    //超級管理者 官方帳號
    public static $ROLE_SUPERADMIN = 'SUPERADMIN';

    //商家角色列表
    public static $store = [
        //商家最高管理者
        'ADMIN',
        //商家次級管理者
        'MANAGER'
    ];
}