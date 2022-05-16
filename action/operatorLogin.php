<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/operator.php";
include_once dirname(__DIR__) . "/dao/OperatorDao.php";

$operator = new Operator();

$operator->setNo($_POST["userId"]);
$operator->setPassword($_POST["userPwd"]);


$OperatorDao = new OperatorDao();
if($OperatorDao->operatorLogin($operator))
{
    
    $datetime = new DateTime();
    $token=md5($operator->getNo().$datetime->format("YmdHis"));
    session_start();
    $_SESSION["OperatorToken"]=$token;

    $result["code"]=Code::OK;
    $result["message"]="成功";
    $result["data"]["name"]=$operator->getName();
    $result["data"]["token"]=$token;
}
else
{
    $result["code"]=Code::ID_NOT_EXIST;
    $result["message"]="用户名或密码错误";
}

echo json_encode($result);