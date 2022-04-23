<?php
include_once dirname(__DIR__) . "/concrete/Database.php";
include_once dirname(__DIR__) . "/concrete/Vaccine.php";

class VaccineDao extends Database
{
    public function setVaccine($vaccine){
        $flag=false;

        if($this->open())
        {
            $petId = $vaccine->getPetId();
            $batch = $vaccine->getBatch();
            $date = $vaccine->getDate();
            $producer = $vaccine->getProducer();
            $place = $vaccine->getPlace();

            $id=$petId.$batch.$date;

            $sql = "insert into vaccines values (?,?,?,?,?,?,0);";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssss",$id,$petId,$batch,$date,$producer,$place);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag = true;
            }
            $stmt->free_result();
        }

        return $flag;
    } 
}