<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";
include_once dirname(__DIR__) . "/dao/PetDao.php";

$pet = new Pet();
$pet->setId($_POST["petId"] == "" ? "%" : "%" . $_POST["petId"] . "%");
$pet->setName($_POST["petName"] == "" ? "%" : "%" . $_POST["petName"] . "%");
$pet->setSpecies($_POST["petSpecies"] == "" ? "%" : "%" . $_POST["petSpecies"] . "%");
$pet->setType($_POST["petType"] == "" ? "%" : "%" . $_POST["petType"] . "%");
$pet->setGender($_POST["petGender"] == "" ? "%" : "%" . $_POST["petGender"] . "%");
$pet->setIsNeutered($_POST["isNeutered"] == "" ? "%" : "%" . $_POST["isNeutered"] . "%");
$masterId = $_POST["masterId"] == "" ? "%" : "%" . $_POST["masterId"] . "%";

$PetDao = new PetDao();

$pets = $PetDao->queryPet($pet, $masterId);

if (!count($pets)) {
    $result["code"] = Code::QUERY_INFO_NOT_EXIST;
    $result["message"] = "未查询到数据";
} else {
    $result["data"]=array();
    foreach ($pets as $pet) {
        $id = $pet->getId();
        $name = $pet->getName();
        $gender = $pet->getGender();
        $species = $pet->getSpecies();
        $type = $pet->getType();
        $date = $pet->getDate();
        $isNeutered = $pet->getIsNeutered();
        $mId = $pet->getMasterId();
        $mName = $pet->getMasterName();

        $val = array(
            "id" => $id, 
            "name" => $name, 
            "gender" => $gender, 
            "species" => $species, 
            "type" => $type, 
            "date" => $date, 
            "isNeutered" => $isNeutered, 
            "masterId" => $mId, 
            "masterName" => $mName, 
        );

        array_push($result["data"], $val);
    }

    $result["code"] = Code::OK;
    $result["message"] = "成功";
}

echo json_encode($result);