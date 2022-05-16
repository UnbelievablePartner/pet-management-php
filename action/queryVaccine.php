<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Vaccine.php";
include_once dirname(__DIR__) . "/dao/VaccineDao.php";

session_start();

if (Code::checkToken()) {

    $vaccine = new Vaccine();
    $vaccine->setPetId($_POST["petId"] == "" ? "%" : "%" . $_POST["petId"] . "%");
    $vaccine->setBatch($_POST["vaccineBatch"] == "" ? "%" : "%" . $_POST["vaccineBatch"] . "%");
    $vaccine->setDate($_POST["vaccineDate"] == "" ? "%" : "%" . $_POST["vaccineDate"] . "%");
    $vaccine->setProducer($_POST["vaccineProducer"] == "" ? "%" : "%" . $_POST["vaccineProducer"] . "%");
    $vaccine->setPlace($_POST["vaccinePlace"] == "" ? "%" : "%" . $_POST["vaccinePlace"] . "%");

    $VaccineDao = new VaccineDao();

    $vaccines = $VaccineDao->queryVaccine($vaccine);

    if (!count($vaccines)) {
        $result["code"] = Code::QUERY_INFO_NOT_EXIST;
        $result["message"] = "未查询到数据";
    } else {
        $result["data"] = array();
        foreach($vaccines as $vaccine)
        {
            $id = $vaccine->getId();
            $petId = $vaccine->getPetId();
            $batch = $vaccine->getBatch();
            $date = $vaccine->getDate();
            $producer = $vaccine->getProducer();
            $place = $vaccine->getPlace();

            $val = array(
                "id" => $id,
                "petId" => $petId,
                "batch" => $batch,
                "date" => $date,
                "producer" => $producer,
                "place" => $place,
            );

            array_push($result["data"], $val);
        }

        $result["code"] = Code::OK;
        $result["message"] = "成功";
    }

    echo json_encode($result);

} else {
    http_response_code(401);
}
