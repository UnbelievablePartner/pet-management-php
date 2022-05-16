<?php

class Code
{
    //正常
    const OK = 200;

    //ID不存在
    const ID_NOT_EXIST = 2001;
    //名下登记宠物过多
    const PET_AMOUNT_MAX = 2002;

    //添加饲主失败
    const MASTER_INSERT_FAILED = 2003;
    //添加宠物失败
    const PET_INSERT_FAILED = 2004;
    //照片添加失败
    const PHOTO_INSERT_FAILED=2005;

    //更新失败
    const PET_UPDATE_FAILED=2006;

    //未查询到信息
    const QUERY_INFO_NOT_EXIST=2007;

    //删除失败
    const DELETE_INFO_FAILED=2008;

    public static function checkToken(){
        return (array_key_exists("HTTP_X_AUTH_TOKEN", $_SERVER) &&  $_SERVER["HTTP_X_AUTH_TOKEN"] == $_SESSION["OperatorToken"]);
    }
}