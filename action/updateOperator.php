<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Operator.php";
include_once dirname(__DIR__) . "/dao/OperatorDao.php";

session_start();

if (Code::checkToken()) {

    $operatorNo = $_POST["operatorNo"];
    $operatorOriginPwd = $_POST["operatorOriginPwd"];

    $checkOperator = new Operator();
    $checkOperator->setNo($operatorNo);
    $checkOperator->setPassword($operatorOriginPwd);

    $OperatorDao = new OperatorDao();

    if (!$OperatorDao->operatorLogin($checkOperator)) {
        $result["code"] = Code::PET_UPDATE_FAILED;
        $result["message"] = "修改失败，请正确输入原密码";
    } else {

        $operator = new Operator();
        $operator->setNo($operatorNo);
        $operator->setName($_POST["operatorName"]);
        $operator->setPassword($_POST["operatorPassword"]);

        if(!$OperatorDao->updateOperator($operator))
        {
            $result["code"] = Code::PET_UPDATE_FAILED;
            $result["message"] = "修改失败";
        }
        else
        {
            $result["code"] = Code::OK;
            $result["message"] = "修改成功";
        }
    }

    echo json_encode($result);

} else {
    http_response_code(401);
}
