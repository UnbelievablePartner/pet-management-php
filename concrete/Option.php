<?php

class Option
{
    private $id;
    private $title;
    private $text;
    private $value;
    private $disabled;
    private $isDelete;

    public function __construct()
    {
        $this->id=0;
        $this->title="";
        $this->text="";
        $this->value=0;
        $this->disabled=false;
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

    //title
    public function setTitle($val)
    {
        $this->title=$val;
    }
    public function getTitle()
    {
        return $this->title;
    }

    //text
    public function setText($val)
    {
        $this->text=$val;
    }
    public function getText()
    {
        return $this->text;
    }

    //value
    public function setValue($val)
    {
        $this->value=$val;
    }
    public function getValue()
    {
        return $this->value;
    }

    //disabled
    public function setDisabled($val)
    {
        $this->disabled=$val;
    }
    public function getDisabled()
    {
        return $this->disabled;
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