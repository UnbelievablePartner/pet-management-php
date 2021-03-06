<?php

//饲主实体类
class Master
{
    private $id;
    private $name;
    private $gender;
    //private $age;
    private $phone;
    private $county;
    private $countyName;
    private $streetOffice;
    private $streetOfficeName;
    private $community;
    private $communityName;
    private $addrDetails;
    private $isDelete;

    public function __construct()
    {
        $this->id="";
        $this->name="";
        $this->gender = 1;
        $this->age = 0;
        $this->phone = "";
        $this->county = "";
        $this->streetOffice = "";
        $this->community = "";
        $this->addrDetails = "";
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

    //gender
    public function setGender($value)
    {
        $this->gender=$value;
    }
    public function getGender()
    {
        return $this->gender;
    }

    //age
    // public function setAge($value)
    // {
    //     $this->age=$value;
    // }
    // public function getAge()
    // {
    //     return $this->age;
    // }

    //phone
    public function setPhone($value)
    {
        $this->phone=$value;
    }
    public function getPhone()
    {
        return $this->phone;
    }

    //county
    public function setCounty($value)
    {
        $this->county=$value;
    }
    public function getCounty()
    {
        return $this->county;
    }

    public function setCountyName($value)
    {
        $this->countyName=$value;
    }
    public function getCountyName()
    {
        return $this->countyName;
    }

    //streetOffice
    public function setStreetOffice($value)
    {
        $this->streetOffice=$value;
    }
    public function getStreetOffice()
    {
        return $this->streetOffice;
    }

    public function setStreetOfficeName($value)
    {
        $this->streetOfficeName=$value;
    }
    public function getStreetOfficeName()
    {
        return $this->streetOfficeName;
    }

    //community
    public function setCommunity($value)
    {
        $this->community=$value;
    }
    public function getCommunity()
    {
        return $this->community;
    }

    public function setCommunityName($value)
    {
        $this->communityName=$value;
    }
    public function getCommunityName()
    {
        return $this->communityName;
    }

    //addrDetails
    public function setAddrDetails($value)
    {
        $this->addrDetails=$value;
    }
    public function getAddrDetails()
    {
        return $this->addrDetails;
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
}
