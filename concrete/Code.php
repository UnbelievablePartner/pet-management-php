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

    //宠物更新失败
    const PET_UPDATE_FAILED=2006;

}