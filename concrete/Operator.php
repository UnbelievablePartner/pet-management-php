<?php
class Operator
{
    private $id;
    private $name;
    private $password;
    private $isDelete;

    public function __construct()
    {
        $this->id = 0;
        $this->name = "";
        $this->password = "";
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

    //password
    public function setPassword($value)
    {
        $this->password=$value;
    }
    public function getPassword()
    {
        return $this->password;
    }

    //isDelete
    public function setIsDelete($val)
    {
        $this->isDelete = $val;
    }
    public function getIsDelete()
    {
        return $this->isDelete;
    }
}
