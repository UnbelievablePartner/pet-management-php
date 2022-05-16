<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Operator.php";
include_once dirname(__DIR__) . "/dao/OperatorDao.php";

session_start();

if (Code::checkToken()) {

    $result = array();

    $operator = new Operator();
    $operator->setNo($_POST["operatorNo"]);
    $operator->setPassword($_POST["operatorPassword"]);

    $OperatorDao = new OperatorDao();

    if ($OperatorDao->deleteOperator($operator)) {
        $result["code"] = Code::OK;
        $result["message"] = "成功";
    }
    else
    {
        $result["code"] = Code::DELETE_INFO_FAILED;
        $result["message"] = "删除失败,请检查该账号密码是否输入正确";
    }

    echo json_encode($result);

} else {
    http_response_code(401);
}
