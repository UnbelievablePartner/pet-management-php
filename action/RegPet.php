<?php
include_once dirname(__DIR__) . "/concrete/Code.php";
include_once dirname(__DIR__) . "/concrete/Master.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";
include_once dirname(__DIR__) . "/dao/MasterDao.php";
include_once dirname(__DIR__) . "/dao/PetDao.php";

session_start();

if (Code::checkToken()) {

    $result = array();

    $GLOBALS["photoPath"] = [];

    if ($_POST["append"] == "false") {

        if (!setPhotos()) {
            $result["code"] = Code::PET_INSERT_FAILED;
            $result["massage"] = "登记照片上传失败";
        } else if (!setMaster()) {
            $result["code"] = Code::MASTER_INSERT_FAILED;
            $result["massage"] = "登记饲主失败";
        } else if (!setPet()) {
            $result["code"] = Code::PET_INSERT_FAILED;
            $result["massage"] = "登记宠物失败,请检查该宠物或编号是否已登记过";
        } else {
            $result["code"] = Code::OK;
            $result["massage"] = "登记成功";
        }

    } else {

        if (!$res = setPhotos()) {
            $result["code"] = Code::PET_INSERT_FAILED;
            $result["massage"] = "登记照片上传失败";
        } else if (!setPet()) {
            $result["code"] = Code::PET_INSERT_FAILED;
            $result["massage"] = "登记宠物失败,请检查该宠物或编号是否已登记过";
        } else {
            $result["code"] = Code::OK;
            $result["massage"] = "登记成功";
        }

    }
    echo json_encode($result);

} else {
    http_response_code(401);
}

//函数
function setMaster()
{

    $master = new Master();
    $master->setId($_POST["masterId"]);
    $master->setName($_POST["masterName"]);
    $master->setGender($_POST["masterGender"]);
    $master->setPhone($_POST["masterPhone"]);
    $master->setCounty($_POST["masterAddrCounty"]);
    $master->setStreetOffice($_POST["masterAddrStreetOffice"]);
    $master->setCommunity($_POST["masterAddrCommunity"]);
    $master->setAddrDetails($_POST["masterAddrDetails"]);

    $MasterDao = new MasterDao();

    return $MasterDao->setMaster($master);

}

function setPet()
{

    $masterId = $_POST["masterId"];
    $pet = new Pet();
    $pet->setId($_POST["petId"]);
    $pet->setName($_POST["petName"]);
    $pet->setSpecies($_POST["petSpecies"]);
    $pet->setType($_POST["petType"]);
    $pet->setGender($_POST["petGender"]);
    $pet->setDate($_POST["petDate"]);
    $pet->setIsNeutered($_POST["isNeutered"]);
    $pet->setComment($_POST["petComments"]);
    $pet->setPhotos(json_encode($GLOBALS["photoPath"]));

    $PetDao = new PetDao();

    return $PetDao->setPet($pet, $masterId);

}

function setPhotos()
{

    if (!count($_FILES)) {
        $GLOBALS["photoPath"]["photo0"] = "/upload/default/default.jpg";
        return true;
    }

//存储文件夹名，格式： 身份证号+宠物芯片编号
    $pathName = $_POST["masterId"] . $_POST["petId"];
//存储路径配置信息
    $dir = iconv("UTF-8", "GBK", dirname(__DIR__) . "/upload/" . $pathName);
//若不存在对应的文件夹，就新建一个
    if (!file_exists($dir)) {
        mkdir($dir);
    }

//从请求中读取数据
    foreach ($_FILES as $fileInfo) {
        //遍历文件数组
        for ($i = 0; $i < count($fileInfo["name"]); $i++) {
            if ($fileInfo["error"][$i] == 0) {
                //获取扩展名
                $ext = strtolower(pathinfo($fileInfo["name"][$i], PATHINFO_EXTENSION));
                //拼接文件名
                $fileName = $pathName . microtime() . "." . $ext;
                //拼接存储路径
                $destName = dirname(__DIR__) . "/upload/" . $pathName . "/" . $fileName;
                //将相对路径存入数组
                $GLOBALS["photoPath"]["photo$i"] = "/upload/" . $pathName . "/" . $fileName;
                //将缓存区的文件移动保存至指定路径
                if (!move_uploaded_file($fileInfo["tmp_name"][$i], $destName)) {
                    //保存失败
                    return false;
                }
            }
        }

    }
    return true;
}
