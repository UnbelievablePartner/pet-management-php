<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";
include_once dirname(__DIR__) . "/dao/PetDao.php";

session_start();

if (Code::checkToken()) {

    $json = file_get_contents("php://input");

    $reception = json_decode($json);

    $petId = $reception->petId;

    $petDao = new PetDao();

    if ($petDao->deletePet($petId)) {
        $result["code"] = Code::OK;
        $result["message"] = "成功";
    } else {
        $result["code"] = Code::DELETE_INFO_FAILED;
        $result["message"] = "删除失败";
    }

    echo json_encode($result);
} else {
    http_response_code(401);
}
