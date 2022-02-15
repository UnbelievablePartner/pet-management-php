<?php
include_once dirname(__DIR__)."/concrete/Code.php";
include_once dirname(__DIR__)."/concrete/Master.php";
include_once dirname(__DIR__)."/dao/MasterDao.php";


$json = file_get_contents("php://input");

$reception = json_decode($json);

$mId=$reception->masterId;
$pIsDel=$reception->pIsDel?0:$reception->pIsDel;
$mIsDel=$reception->mIsDel?0:$reception->mIsDel;


$result=array();

$MasterDao = new MasterDao();

$res = $MasterDao -> getMasterById($mId,$pIsDel,$mIsDel);

if(!$res["flag"]){
    $result["code"]=Code::ID_NOT_EXIST;
    $result["massage"]="OK";
}
else if ($res["count"]>=3){
    $result["code"]=Code::PET_AMOUNT_MAX;
    $result["massage"]="该身份证号下已登记宠物数量达到上限";
}
else{
    $data=$res["data"];
    $result["code"]=Code::OK;
    $result["massage"]="OK";
    $result["data"]=array(
        "masterName"=>$data->getName(),
            "masterId"=>$data->getId(),
            "masterGender"=>$data->getGender(),
            "masterPhone"=>$data->getPhone(),
            "masterCounty"=>$data->getCounty(),
            "masterStreetOffice"=>$data->getStreetOffice(),
            "masterCommunity"=>$data->getCommunity(),
            "masterAddrDetails"=>$data->getAddrDetails(),
            "masterIsDelete"=>$data->getIsDelete()
    );
}

echo json_encode($result);