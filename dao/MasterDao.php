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

    public function queryMaster($master)
    {
        $results = array();

        if ($this->open()) {
            $id = $master->getId();
            $name = $master->getName();
            $gender = $master->getGender();
            $phone = $master->getPhone();
            $county = $master->getCounty();
            $streetOffice = $master->getStreetOffice();
            $community = $master->getCommunity();
            $addrDetails = $master->getAddrDetails();

            $sql = "select `name`,m.id,gender,phone,m.county,cou.county,m.streetOffice,s.streetOffice,m.community,com.community,addr,m.isdelete from masters m left join counties cou on m.county=cou.id left join streetoffices s on m.streetOffice=s.id left join communities com on m.community=com.id where `name` like ? and m.id like ? and gender like ? and phone like ? and m.county like ? and m.streetOffice like ? and m.community like ? and addr like ? and m.isdelete=0;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssssss", $name, $id, $gender, $phone, $county, $streetOffice, $community, $addrDetails);
            $stmt->bind_result($masterName, $masterId, $masterGender, $masterPhone, $masterCounty, $masterCountyName, $masterStreetOffice, $masterStreetOfficeName, $masterCommunity, $masterCommunityName, $masterAddrDetails, $isDelete);
            $stmt->execute();
            while ($stmt->fetch()) {
                $master = new Master();
                $master->setId($masterId);
                $master->setName($masterName);
                $master->setGender($masterGender);
                $master->setPhone($masterPhone);
                $master->setCounty($masterCounty);
                $master->setCountyName($masterCountyName);
                $master->setStreetOffice($masterStreetOffice);
                $master->setStreetOfficeName($masterStreetOfficeName);
                $master->setCommunity($masterCommunity);
                $master->setCommunityName($masterCommunityName);
                $master->setAddrDetails($masterAddrDetails);
                $master->setIsDelete($isDelete);

                array_push($results,$master);
            }
            $stmt->free_result();
        }

        return $results;
    }

    public function updateMaster($master){

        $flag=false;

        if ($this->open()) {
            $id = $master->getId();
            $name = $master->getName();
            $phone = $master->getPhone();
            $county = $master->getCounty();
            $streetOffice = $master->getStreetOffice();
            $community = $master->getCommunity();
            $addrDetails = $master->getAddrDetails();

            $sql = "update masters set name=?,phone=?,county=?,streetOffice=?,community=?,addr=? where id=?;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $phone, $county, $streetOffice, $community, $addrDetails,$id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function deleteMaster($masterId)
    {
        $flag=false;

        if ($this->open()) {
            $sql = "update masters set isDelete=1 where id=?;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $masterId);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }
}
