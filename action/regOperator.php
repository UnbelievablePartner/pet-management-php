<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Operator.php";
include_once dirname(__DIR__) . "/dao/OperatorDao.php";

session_start();

if (Code::checkToken()) {

    $result = array();

    $operator = new Operator();
    $operator->setNo($_POST["operatorNo"]);
    $operator->setName($_POST["operatorName"]);
    $operator->setPassword($_POST["operatorPassword"]);
    $operator->setId($_POST["operatorId"]);

    $OperatorDao = new OperatorDao();

    if ($OperatorDao->setOperator($operator)) {
        $result["code"] = Code::OK;
        $result["massage"] = "登记成功";
    } else {
        $result["code"] = Code::PET_INSERT_FAILED;
        $result["massage"] = "操作员登记失败";
    }

    echo json_encode($result);

} else {
    http_response_code(401);
}
