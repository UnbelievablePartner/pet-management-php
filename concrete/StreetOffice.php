<?php
class StreetOffice
{
    private $id;
    private $streetOffice;
    private $ofCounty;
    private $isDelete;

    public function __construct()
    {
        $this->id="";
        $this->streetOffice="";
        $this->ofCounty="";
        $this->isDelete=0;
    }

     //id
     public function setId($val)
     {
         $this->id=$val;
     }
     public function getId()
     {
         return $this->id;
     }
 
     //streetOffice
     public function setStreetOffice($val)
     {
         $this->streetOffice=$val;
     }
     public function getStreetOffice()
     {
         return $this->streetOffice;
     }

     //ofCounty
     public function setOfCounty($val)
     {
         $this->ofCounty=$val;
     }
     public function getOfCounty()
     {
        return $this->ofCounty;
     }
 
     //isDelete
     public function setIsDelete($val)
     {
         $this->isDelete=$val;
     }
     public function getIsDelete()
     {
         return $this->isDelete;
     }
}