<?php
class County
{
    private $id;
    private $county;
    private $isDelete;

    public function __construct()
    {
        $this->id="";
        $this->county="";
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

    //county
    public function setCounty($val)
    {
        $this->county=$val;
    }
    public function getCounty()
    {
        return $this->county;
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