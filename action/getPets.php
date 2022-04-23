<?php

include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";
include_once dirname(__DIR__) . "/dao/PetDao.php";
include_once dirname(__DIR__) . "/dao/MasterDao.php";

$json = $json = file_get_contents("php://input");

$reception = json_decode($json);

$type = $reception->queryType;
$id = $reception->id;
$isDel = $reception->isDel;

$PetDao = new PetDao();

$masterDao = new MasterDao();

if (!($mResult = $masterDao->getMasterById($id, 0, 0))["flag"]) {
    $result["code"] = Code::ID_NOT_EXIST;
    $result["message"] = "身份证号不存在";
} else if (!count($pResult = $PetDao->getPetById($type, $id, $isDel))) {
    $result["code"] = Code::ID_NOT_EXIST;
    $result["message"] = "未查询到宠物";
} else {
    $data = array();
    foreach ($pResult as $pet) {
        $id = $pet->getId();
        $name = $pet->getName();
        $gender = $pet->getGender();
        $species = $pet->getSpecies();
        $type = $pet->getType();
        $date = $pet->getDate();
        $isNeutered = $pet->getIsNeutered();
        $comments = $pet->getComment();
        $photos = $pet->getPhotos();
        $isDelete = $pet->getIsDelete();

        $val = array("id" => $id, "name" => $name, "gender" => $gender, "species" => $species, "type" => $type, "date" => $date, "isNeutered" => $isNeutered, "Comment" => $comments, "photos" => $photos, "isDelete" => $isDelete);
        array_push($data, $val);
    }
    $master = $mResult["data"];
    $val = array("masterId" => ($master->getId()), "masterName" => ($master->getName()));

    $result["code"] = Code::OK;
    $result["message"] = "查询成功";
    $result["data"] = array("pets" => $data, "masterInfo" => $val);
}

echo json_encode($result);
