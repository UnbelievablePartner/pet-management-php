<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Master.php";
include_once dirname(__DIR__) . "/dao/MasterDao.php";

$result = array();
$result["data"]=array();

$master = new Master();
$master->setId($_POST["masterId"] == "" ? "%" : "%" . $_POST["masterId"] . "%");
$master->setName($_POST["masterName"] == "" ? "%" : "%" . $_POST["masterName"] . "%");
$master->setGender($_POST["masterGender"] == "" ? "%" : "%" . $_POST["masterGender"] . "%");
$master->setPhone($_POST["masterPhone"] == "" ? "%" : "%" . $_POST["masterPhone"] . "%");
$master->setCounty($_POST["masterAddrCounty"] == "" ? "%" : "%" . $_POST["masterAddrCounty"] . "%");
$master->setStreetOffice($_POST["masterAddrStreetOffice"] == "" ? "%" : "%" . $_POST["masterAddrStreetOffice"] . "%");
$master->setCommunity($_POST["masterAddrCommunity"] == "" ? "%" : "%" . $_POST["masterAddrCommunity"] . "%");
$master->setAddrDetails($_POST["masterAddrDetails"] == "" ? "%" : "%" . $_POST["masterAddrDetails"] . "%");

$MasterDao = new MasterDao();
$res = $MasterDao->queryMaster($master);

if (!count($res)) {
    $result["code"] = Code::QUERY_INFO_NOT_EXIST;
    $result["message"] = "未查询到数据";
} else {
    foreach ($res as $mst) {
        $id = $mst->getId();
        $name = $mst->getName();
        $gender = $mst->getGender();
        $phone = $mst->getPhone();
        $county = $mst->getCounty();
        $countyName=$mst->getCountyName();
        $streetOffice = $mst->getStreetOffice();
        $streetOfficeName = $mst->getStreetOfficeName();
        $community = $mst->getCommunity();
        $communityName = $mst->getCommunityName();
        $addrDetails = $mst->getAddrDetails();
        $isDelete = $mst ->getIsDelete();

        $val = array(
            "id"=>$id,
            "name"=>$name,
            "gender"=>$gender,
            "phone"=>$phone,
            "county"=>$county,
            "countyName"=>$countyName,
            "streetOffice"=>$streetOffice,
            "streetOfficeName"=>$streetOfficeName,
            "community"=>$community,
            "communityName"=>$communityName,
            "addrDetails"=>$addrDetails,
            "isDelete"=>$isDelete
        );

        array_push($result["data"],$val);
    }

    $result["code"]=Code::OK;
    $result["message"]="成功";
}

echo json_encode($result);