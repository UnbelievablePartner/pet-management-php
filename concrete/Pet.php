<?php
class Pet
{
    private $id;
    private $name;
    private $species;
    private $type;
    private $gender;
    private $date;
    private $isNeutered;
    private $comment;
    private $photos;
    private $isDelete;

    public function __construct()
    {
        $this->id="";
        $this->name = "";
        $this->species = 1;
        $this->type = "";
        $this->gender = "";
        $this->date = "";
        $this->isNeutered = 0;
        $this->comment = "";
        $this->photos=array();
        $this->isDelete = 0;
    }

    //id
    public function setId($value)
    {
        $this->id=$value;
    }
    public function getId()
    {
        return $this->id;
    }

    //name
    public function setName($value)
    {
        $this->name=$value;
    }
    public function getName()
    {
        return $this->name;
    }

    //species
    public function setSpecies($value)
    {
        $this->species=$value;
    }
    public function getSpecies()
    {
        return $this->species;
    }

    //type
    public function setType($value)
    {
        $this->type=$value;
    }
    public function getType()
    {
        return $this->type;
    }

    //gender
    public function setGender($value)
    {
        $this->gender=$value;
    }
    public function getGender()
    {
        return $this->gender;
    }

    //date
    public function setDate($value)
    {
        $this->date=$value;
    }
    public function getDate()
    {
        return $this->date;
    }

    //isNeutered
    public function setIsNeutered($value)
    {
        $this->isNeutered=$value;
    }
    public function getIsNeutered()
    {
        return $this->isNeutered;
    }

    //comment
    public function setComment($value)
    {
        $this->comment=$value;
    }
    public function getComment()
    {
        return $this->comment;
    }

    //isDelete
    public function setIsDelete($value)
    {
        $this->isDelete=$value;
    }
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    public function setPhotos($value)
    {
        $this->photos = $value;
    }
    public function getPhotos()
    {
        return $this->photos;
    }
}