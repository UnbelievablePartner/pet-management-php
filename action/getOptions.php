<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Option.php";
include_once dirname(__DIR__) . "/dao/OptionDao.php";

session_start();
//array_key_exists("HTTP_X_AUTH_TOKEN", $_SERVER) &&  $_SERVER["HTTP_X_AUTH_TOKEN"] == $_SESSION["OperatorToken"]

if ( Code::checkToken() ) {

    $title = $_GET["title"];
    $isDel = $_GET["isDel"];

    $OptionDao = new OptionDao();

    $options = $OptionDao->getOptionsByTitle($title);

    $data = array();

    foreach ($options as $option) {
        $id = $option->getId();
        $text = $option->getText();
        $value = $option->getValue();
        $disabled = $option->getDisabled();
        $isDel = $option->getIsDelete();

        $val = array("id" => $id, "text" => $text, "value" => $value, "disabled" => $disabled, "isDel" => $isDel);

        array_push($data, $val);
    }

    $result["code"] = Code::OK;
    $result["message"] = "成功";
    $result["data"] = $data;

    echo json_encode($result);

}
else
{
    http_response_code(401);
}
