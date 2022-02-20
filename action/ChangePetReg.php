<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Master.php";
include_once dirname(__DIR__) . "/dao/MasterDao.php";
include_once dirname(__DIR__) . "/dao/PetDao.php";



$append = $_POST["append"];

$petId= $_POST["petId"];
$masterId=$_POST["masterId"];

$petDao = new PetDao();

if($append=="false"){
    if(!setMaster()){
        $result["code"] = Code::MASTER_INSERT_FAILED;
        $result["massage"] = "登记饲主失败";
    }
    else if(!$petDao->updatePetMasterId($petId,$masterId))
    {
        $result["code"] = Code::PET_UPDATE_FAILED;
        $result["massage"] = "变更登记失败";
    }
    else{
        $result["code"] = Code::OK;
        $result["massage"] = "变更登记成功";
    }
}
else{
    if(!$petDao->updatePetMasterId($petId,$masterId))
    {
        $result["code"] = Code::PET_UPDATE_FAILED;
        $result["massage"] = "变更登记失败";
    }
    else{
        $result["code"] = Code::OK;
        $result["massage"] = "变更登记成功";
    }
}

echo json_encode($result);

function setMaster()
{

    $master = new Master();
    $master->setId($_POST["masterId"]);
    $master->setName($_POST["masterName"]);
    $master->setGender($_POST["masterGender"]);
    $master->setPhone($_POST["masterPhone"]);
    $master->setCounty($_POST["masterAddrCounty"]);
    $master->setStreetOffice($_POST["masterAddrStreetOffice"]);
    $master->setCommunity($_POST["masterAddrCommunity"]);
    $master->setAddrDetails($_POST["masterAddrDetails"]);

    $MasterDao = new MasterDao();

    return $MasterDao->setMaster($master);

}