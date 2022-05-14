<?php
include_once dirname(__DIR__) . "/concrete/Code.php";

session_start();

if(Code::checkToken())
{
    unset($_SESSION["OperatorToken"]);
}

$result["code"]=Code::OK;

echo json_encode($result);