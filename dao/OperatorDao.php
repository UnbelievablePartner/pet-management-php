<?php
include_once dirname(__DIR__) . "/concrete/Database.php";
include_once dirname(__DIR__) . "/concrete/operator.php";

class OperatorDao extends Database
{
    public function operatorLogin($operator)
    {
        $flag = false;

        if ($this->open()) {

            $operatorNo = $operator->getNo();
            $operatorPwd = $operator->getPassword();

            $sql = "select name from operators where no=? and pwd=? and isdelete=0;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $operatorNo, $operatorPwd);
            $stmt->bind_result($name);
            $stmt->execute();
            if ($stmt->fetch()) {
                $flag = true;
                $operator->setName($name);
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function setOperator($operator)
    {
        $flag = false;

        if ($this->open()) {
            $operatorNo = $operator->getNo();
            $operatorName = $operator->getName();
            $operatorPassword = $operator->getPassword();
            $operatorId = $operator->getId();

            $sql = "insert into operators values (?,?,?,?,0);";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $operatorName, $operatorNo, $operatorId, $operatorPassword);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag = true;
            }
            $stmt->free_result();
        }

        return $flag;
    }

    public function queryOperator($operator)
    {
        $result = array();

        if ($this->open()) {

            $operatorNo = $operator->getNo();
            $operatorName = $operator->getName();
            $operatorId = $operator->getId();

            $sql = "select no,name,id from operators where no like ? and name like ? and id like ? and isDelete=0;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $operatorNo, $operatorName, $operatorId);
            $stmt->bind_result($no, $name, $id);
            $stmt->execute();
            while ($stmt->fetch()) {
                $operator = new Operator();
                $operator->setNo($no);
                $operator->setName($name);
                $operator->setId($id);

                array_push($result, $operator);
            }
            $stmt->free_result();
        }

        return $result;
    }

    public function updateOperator($operator)
    {
        $flag = false;

        if ($this->open()) {
            $operatorNo = $operator->getNo();
            $operatorName = $operator->getName();
            $operatorPassword = $operator->getPassword();

            $sql = "update operators set name=?,pwd=? where no=?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $operatorName, $operatorPassword, $operatorNo);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag = true;
            }
            $stmt->free_result();

        }

        return $flag;
    }

    public function deleteOperator($operator)
    {
        $flag = false;

        if ($this->open()) {
            $operatorNo = $operator->getNo();
            $operatorPassword = $operator->getPassword();

            $sql = "update operators set isDelete=1 where no=? and pwd=?";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $operatorNo, $operatorPassword);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $flag = true;
            }
            $stmt->free_result();

        }

        return $flag;
    }
}
