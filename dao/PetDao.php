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
}