<?php
include_once dirname(__DIR__)."/concrete/Database.php";
include_once dirname(__DIR__)."/concrete/operator.php";

class OperatorDao extends Database
{
    public function operatorLogin($operator)
    {
        $flag=false;

        if ($this->open()) {

            $operatorId=$operator->getId();
            $operatorPwd=$operator->getPassword();

            $sql = "select name from operators where no=? and pwd=? and isdelete=0;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss",$operatorId,$operatorPwd);
            $stmt->bind_result($name);
            $stmt->execute();
            if($stmt->fetch())
            {
                $flag=true;
                $operator->setName($name);
            }
            $stmt->free_result();
        }

        return $flag;
    }
}