<?php
include_once dirname(__DIR__) . "/concrete/Database.php";
include_once dirname(__DIR__) . "/concrete/Master.php";
include_once dirname(__DIR__) . "/concrete/Pet.php";

class MasterDao extends Database
{
    public function getMasterById($mId, $pIsDel, $mIsDel)
    {
        $result = array();
        $master = new Master();
        $count = 0;
        $flag = false;

        if ($this->open()) {
            $sql = "select *,(select count(chipNo) from pets where masterId = ? and isDelete=?) as 'petCount' from masters where id=? and isDelete=?;";

            //$sql="select *,(select count(chipNo) from pets where masterId = '111111200001011111' and isDelete=1) as 'petCount' from masters where id='111111200001011111' and isDelete=0;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sisi", $mId, $pIsDel, $mId, $mIsDel);
            $stmt->bind_result($masterName, $masterId, $masterGender, $masterPhone, $masterCounty, $masterStreetOffice, $masterCommunity, $masterAddrDetails, $isDelete, $petCount);
            $stmt->execute();
            if ($stmt->fetch()) {
                $flag = true;
                $master->setId($masterId);
                $master->setName($masterName);
                $master->setGender($masterGender);
                $master->setPhone($masterPhone);
                $master->setCounty($masterCounty);
                $master->setStreetOffice($masterStreetOffice);
                $master->setCommunity($masterCommunity);
                $master->setAddrDetails($masterAddrDetails);
                $master->setIsDelete($isDelete);

                $flag = true;
                $count = $petCount;
            }
            $stmt->free_result();
        }

        $result["flag"] = $flag;
        $result["count"] = $count;
        $result["data"] = $master;

        return $result;
    }

    public function setMaster($master)
    {
        $flag = false;

        if ($this->open()) {
            $id = $master->getId();
            $name = $master->getName();
            $gender = $master->getGender();
            $phone = $master->getPhone();
            $county = $master->getCounty();
            $streetOffice = $master->getStreetOffice();
            $community = $master->getCommunity();
            $addrDetails = $master->getAddrDetails();

            $sql = "insert into masters values (?,?,?,?,?,?,?,?,0);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisssss", $name, $id, $gender, $phone, $county, $streetOffice, $community, $addrDetails);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag = true;
            }
            $stmt->free_result();
        }

        return $flag;
    }
}
