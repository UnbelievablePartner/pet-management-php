<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Master.php";
include_once dirname(__DIR__) . "/dao/MasterDao.php";

session_start();

if (Code::checkToken()) {

    $result = array();

    $master = new Master();
    $master->setId($_POST["masterId"]);
    $master->setName($_POST["masterName"]);
    $master->setPhone($_POST["masterPhone"]);
    $master->setCounty($_POST["masterAddrCounty"]);
    $master->setStreetOffice($_POST["masterAddrStreetOffice"]);
    $master->setCommunity($_POST["masterAddrCommunity"]);
    $master->setAddrDetails($_POST["masterAddrDetails"]);

    $MasterDao = new MasterDao();

    if ($MasterDao->updateMaster($master)) {
        $result["code"] = Code::OK;
        $result["message"] = "成功";
    } else {
        $result["code"] = Code::ID_NOT_EXIST;
        $result["message"] = "操作失败，请检查身份证号是否正确";
    }

    echo json_encode($result);

} else {
    http_response_code(401);
}
