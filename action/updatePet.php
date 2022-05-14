<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";
include_once dirname(__DIR__) . "/dao/PetDao.php";

session_start();

if (Code::checkToken()) {

    $result = array();

    $pet = new Pet();
    $pet->setMasterId($_POST["masterId"]);
    $pet->setId($_POST["petId"]);
    $pet->setName($_POST["petName"]);
    $pet->setSpecies($_POST["petSpecies"]);
    $pet->setType($_POST["petType"]);
    $pet->setGender($_POST["petGender"]);
    $pet->setIsNeutered($_POST["isNeutered"]);

    $PetDao = new PetDao();

    if ($PetDao->updatePet($pet)) {
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
