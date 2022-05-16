<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Vaccine.php";
include_once dirname(__DIR__) . "/dao/VaccineDao.php";

session_start();

if (Code::checkToken()) {

    $json = file_get_contents("php://input");

    $reception = json_decode($json);

    $vaccineId = $reception->vaccineId;

    $vaccineDao = new VaccineDao();

    if ($vaccineDao->deleteVaccine($vaccineId)) {
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
