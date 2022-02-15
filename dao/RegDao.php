<?php
include_once dirname(__DIR__) . "/concrete/Database.php";
include_once dirname(__DIR__) . "/concrete/Master.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";
include_once dirname(__DIR__) . "/concrete/Vaccine.php";

class RegDao extends Database
{
    public function getMasterById($mId,$pIsDel,$mIsDel)
    {
        $result = array();
        $master = new Master();
        $count = 0;

        if ($this->open()) {
            $sql = "select *,(select count(chipNo) from pets where masterId = ? and isDelete=?) as 'petCount' from masters where id=? and isDelete=?;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sisi", $mId,$pIsDel,$mId,$mIsDel);
            $stmt->bind_result($masterName, $masterId, $masterGender, $masterPhone, $masterCounty, $masterStreetOffice, $masterCommunity, $masterAddr, $isDelete, $petCount);
            $stmt->execute();
            if ($stmt->fetch()) {
                $flag = true;
                $master->getId($masterId);
                $master->getName($masterName);
                $master->getGender($masterGender);
                // $master->getAge($masterAge);
                $master->getPhone($masterPhone);
                $master->getCounty($masterCounty);
                $master->getStreetOffice($masterStreetOffice);
                $master->getCommunity($masterCommunity);
                $master->getAddrDetails($masterAddrDetails);
                $master->setIsDelete($isDelete);

                $flag=true;
                $count=$petCount;
            }
            $stmt->free_result();
        }

        $result["flag"] = $flag;
        $result["count"] = $count;
        $result["data"] = $master;

        return $result;
    }
}
