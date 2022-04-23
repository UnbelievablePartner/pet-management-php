<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Vaccine.php";
include_once dirname(__DIR__) . "/dao/VaccineDao.php";

$result = array();

$vaccine = new Vaccine();
$vaccine->setPetId($_POST["petId"]);
$vaccine->setBatch($_POST["vaccineBatch"]);
$vaccine->setDate($_POST["vaccineDate"]);
$vaccine->setProducer($_POST["vaccineProducer"]);
$vaccine->setPlace($_POST["vaccinePlace"]);

$VaccineDao = new VaccineDao();

if($VaccineDao->setVaccine($vaccine)){
    $result["code"] = Code::OK;
    $result["massage"] = "登记成功";
}else{
    $result["code"] = Code::PET_INSERT_FAILED;
    $result["massage"] = "疫苗登记失败";
}

echo json_encode($result);