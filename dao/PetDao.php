<?php
include_once dirname(__DIR__)."/concrete/Database.php";
include_once dirname(__DIR__)."/concrete/Master.php";
include_once dirname(__DIR__)."/concrete/Pet.php";
class PetDao extends Database
{
    public function setPet($pet,$masterId){
        $flag = false;

        if ($this->open()) {
            $id = $pet->getId();
            $name = $pet->getName();
            $gender = $pet->getGender();
            $species = $pet->getSpecies();
            $type = $pet->getType();
            $date = $pet->getDate();
            $isNeutered = $pet->getIsNeutered();
            $comments = $pet->getcomment();
            $photos = $pet->getPhotos();

            $sql = "insert into pets values(?,?,?,?,?,?,?,?,?,?,0);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssisisiss",$name,$id,$masterId,$species,$type,$gender,$date,$isNeutered,$photos,$comments);
            $stmt->execute();
            if($stmt->affected_rows==1)
            {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function getPetById($qtype,$id,$isDel){
        $pets=array();

        if($this->open())
        {
            if($qtype){
                $sql = "select * from pets where masterId=? and isdelete=?;";
            }
            else{
                $sql = "select * from pets where chipNo=? and isdelete=?;";
            }

            $stmt = $this->conn->prepare($sql);

            $stmt -> bind_param("si",$id,$isDel);
            $stmt -> bind_result($name,$pid,$masterId,$species,$type,$gender,$date,$isNeutered,$photos,$comments,$isDelete);
            $stmt->execute();

            while($stmt->fetch()){
                $pet = new Pet();
                $pet->setId($pid);
                $pet->setName($name);
                $pet->setSpecies($species);
                $pet->setType($type);
                $pet->setDate($date);
                $pet->setIsNeutered($isNeutered);
                $pet->setComment($comments);
                $pet->setPhotos($photos);
                $pet->setIsDelete($isDelete);

                array_push($pets,$pet);
            }

        }

        return $pets;
    }

    public function updatePetMasterId($pId,$mId){
        $flag=false;
        
        if($this->open())
        {
            $sql = "update pets set masterId = ? where chipNo=? and isdelete=0;";
            $stmt = $this->conn->prepare($sql);
            $stmt -> bind_param("ss",$mId,$pId);
            $stmt -> execute();
            
            if($stmt->affected_rows ==1)
            {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function queryPet($pet,$mId)
    {
        $result=array();
        
        if($this->open())
        {
            $id = $pet->getId();
            $name = $pet->getName();
            $gender = $pet->getGender();
            $species = $pet->getSpecies();
            $type = $pet->getType();
            $isNeutered = $pet->getIsNeutered();

            $sql = "select p.nickname,p.chipNo,p.masterId,p.species,p.type,p.sex,p.gotdate,p.isNeutered,m.name from pets p left join masters m on p.masterId=m.id where nickname like ? and chipNo like ? and masterId like ? and species like ? and type like ? and sex like ? and isNeutered like ?;";
            $stmt = $this->conn->prepare($sql);
            $stmt -> bind_param("sssssss",$name,$id,$mId,$species,$type,$gender,$isNeutered);
            $stmt -> bind_result($pname,$pid,$mid,$pspecies,$ptype,$psex,$pgotdate,$pisNeutered,$mname);
            $stmt -> execute();
            
            while($stmt->fetch()){
                $pet = new Pet();
                $pet->setId($pid);
                $pet->setName($pname);
                $pet->setMasterId($mid);
                $pet->setMasterName($mname);
                $pet->setGender($psex);
                $pet->setSpecies($pspecies);
                $pet->setType($ptype);
                $pet->setDate($pgotdate);
                $pet->setIsNeutered($pisNeutered);

                array_push($result,$pet);
            }
            $stmt->free_result();
        }

        return $result;
    }

    public function updatePet($pet){

        $flag=false;

        if ($this->open()) {
            $id = $pet->getId();
            $name = $pet->getName();
            $gender = $pet->getGender();
            $species = $pet->getSpecies();
            $type = $pet->getType();
            $isNeutered = $pet->getIsNeutered();

            $sql = "update pets set nickname=?,species=?,type=?,sex=?,isNeutered=? where chipNo=?;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssss", $name, $species, $type, $gender, $isNeutered,$id);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function deletePet($petId)
    {
        $flag=false;

        if ($this->open()) {
            $sql = "update pets set isDelete=1 where chipNo =?;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $petId);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag=true;
            }
            $stmt->free_result();
        }

        return $flag;
    }
}