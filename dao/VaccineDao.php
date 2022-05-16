<?php
include_once dirname(__DIR__) . "/concrete/Database.php";
include_once dirname(__DIR__) . "/concrete/Vaccine.php";

class VaccineDao extends Database
{
    public function setVaccine($vaccine)
    {
        $flag = false;

        if ($this->open()) {
            $petId = $vaccine->getPetId();
            $batch = $vaccine->getBatch();
            $date = $vaccine->getDate();
            $producer = $vaccine->getProducer();
            $place = $vaccine->getPlace();

            $id = $petId . $batch . $date;

            $sql = "insert into vaccines values (?,?,?,?,?,?,0);";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssss", $id, $petId, $batch, $date, $producer, $place);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag = true;
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function queryVaccine($vaccine)
    {

        $result = array();

        if ($this->open()) 
        {
            $petId = $vaccine->getPetId();
            $batch = $vaccine->getBatch();
            $date = $vaccine->getDate();
            $producer = $vaccine->getProducer();
            $place = $vaccine->getPlace();

            $sql = "select * from vaccines where petId like ? and batch like ? and `date` like ? and producer like ? and place like ?;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssss", $petId, $batch, $date, $producer, $place);
            $stmt->bind_result($vid,$vpid,$vbatch,$vdate,$vproducer,$vplace,$isDelete);
            $stmt->execute();
            while ($stmt->fetch()) {
                $vaccine = new Vaccine();
                $vaccine->setId($vid);
                $vaccine->setPetId($vpid);
                $vaccine->setBatch($vbatch);
                $vaccine->setDate($vdate);
                $vaccine->setProducer($vproducer);
                $vaccine->setPlace($vplace);

                array_push($result,$vaccine);
            }
            $stmt->free_result();
        }

        return $result;

    }

    public function deleteVaccine($vaccineId)
    {
        $flag = false;

        if ($this->open()) {
            $sql = "update vaccines set isDelete=1 where id =?;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $vaccineId);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }
}
