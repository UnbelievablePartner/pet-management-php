<?php
class Community
{
    private $id;
    private $community;
    private $ofStreetOffice;
    private $isDelete;

    public function __construct()
    {
        $this->id="";
        $this->community="";
        $this->ofStreetOffice="";
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
 
     //community
     public function setCommunity($val)
     {
         $this->community=$val;
     }
     public function getCommunity()
     {
         return $this->community;
     }

     //ofStreetOffice
     public function setOfStreetOffice($val)
     {
         $this->ofStreetOffice=$val;
     }
     public function getOfStreetOffice()
     {
        return $this->ofStreetOffice;
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