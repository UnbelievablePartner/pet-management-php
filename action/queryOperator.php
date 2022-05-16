<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Operator.php";
include_once dirname(__DIR__) . "/dao/OperatorDao.php";

session_start();

if (Code::checkToken()) {

    $operator = new Operator();
    $operator->setNo($_POST["operatorNo"] == "" ? "%" : "%" . $_POST["operatorNo"] . "%");
    $operator->setName($_POST["operatorName"] == "" ? "%" : "%" . $_POST["operatorName"] . "%");
    $operator->setId($_POST["operatorId"] == "" ? "%" : "%" . $_POST["operatorId"] . "%");

    $OperatorDao = new OperatorDao();

    $operators = $OperatorDao->queryOperator($operator);

    if (!count($operators)) {
        $result["code"] = Code::QUERY_INFO_NOT_EXIST;
        $result["message"] = "未查询到数据";
    } else {
        $result["data"] = array();
        foreach($operators as $operator)
        {
            $operatorNo = $operator->getNo();
            $operatorName = $operator->getName();
            $operatorId = $operator->getId();

            $val = array(
                "no" => $operatorNo,
                "id" => $operatorId,
                "name" => $operatorName,
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
