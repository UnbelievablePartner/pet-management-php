<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/County.php";
include_once dirname(__DIR__) . "/concrete/StreetOffice.php";
include_once dirname(__DIR__) . "/concrete/Community.php";
include_once dirname(__DIR__) . "/dao/AddrDao.php";

session_start();

if (Code::checkToken()) {

    $id = $_GET["id"];
    $isDel = $_GET["isDel"];

    $strLength = strlen($id);

    $data = array();

    $AddrDao = new AddrDao();

    if ($strLength == 0) {
        $counties = $AddrDao->getCounties($isDel);

        foreach ($counties as $item) {
            $id = $item->getId();
            $county = $item->getCounty();
            $isDelete = $item->getIsDelete();

            $val = array("id" => $id, "county" => $county, "isDelete" => $isDelete);

            array_push($data, $val);
        }

    } else if ($strLength == 2) {
        $streetOffices = $AddrDao->getStreetOfficesByCountyId($id, $isDel);

        foreach ($streetOffices as $item) {
            $id = $item->getId();
            $streetOffice = $item->getStreetOffice();
            $ofCounty = $item->getOfCounty();
            $isDelete = $item->getIsDelete();

            $val = array("id" => $id, "streetOffice" => $streetOffice, "ofCounty" => $ofCounty, "isDelete" => $isDelete);

            array_push($data, $val);

        }
    } else if ($strLength == 4) {

        $communities = $AddrDao->getCommunitiesByStreetOfficeId($id, $isDel);

        foreach ($communities as $item) {
            $id = $item->getId();
            $community = $item->getCommunity();
            $ofStreetOffice = $item->getOfStreetOffice();
            $isDelete = $item->getIsDelete();

            $val = array("id" => $id, "community" => $community, "ofStreetOffice" => $ofStreetOffice, "isDelete" => $isDelete);

            array_push($data, $val);

        }
    }

    $result["code"] = Code::OK;
    $result["message"] = "成功";
    $result["data"] = $data;

    echo json_encode($result);

} else {
    http_response_code(401);
}
