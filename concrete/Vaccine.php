<?php
class Vaccine
{
    private $id;
    private $petId;
    private $batch;
    private $date;
    private $producer;
    private $place;
    private $isDelete;

    public function __construct()
    {
        $this->id="";
        $this->petId="";
        $this->batch="";
        $this->date="";
        $this->producer="";
        $this->place="";
        $this->isDelete=0;
    }

    public function setId($val)
    {
        $this->id=$val;
    }
    public function getId(){
        return $this->id;
    }

    public function setPetId($val)
    {
        $this->petId=$val;
    }
    public function getPetId(){
        return $this->petId;
    }

    public function setBatch($val)
    {
        $this->batch=$val;
    }
    public function getBatch()
    {
        return $this->batch;
    }

    public function setDate($val)
    {
        $this->date=$val;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setProducer($val)
    {
        $this->producer=$val;
    }
    public function getProducer()
    {
        return $this->producer;
    }

    public function setPlace($val)
    {
        $this->place=$val;
    }
    public function getPlace()
    {
        return $this->place;
    }

    public function setIsDelete($val)
    {
        $this->isDelete=$val;
    }
    public function getIsDelete()
    {
        return $this->isDelete;
    }
}