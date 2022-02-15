<?php
include_once dirname(__DIR__)."/concrete/Database.php";
include_once dirname(__DIR__)."/concrete/Option.php";

class OptionDao extends Database
{
    public function getOptionsByTitle($title)
    {
        $options = array();

        if($this->open()){

            $sql="select id,text,value,disabled,isDelete from options where title=? and isDelete=0 order by value desc;";

            $stmt = $this->conn->prepare($sql);
            $stmt -> bind_param("s",$title);
            $stmt -> bind_result($id,$text,$value,$disabled,$isDelete);
            $stmt -> execute();

            while($stmt -> fetch())
            {
                $option = new Option();
                $option->setId($id);
                $option->setText($text);
                $option->setValue($value);
                $option->setDisabled($disabled);
                $option->setIsDelete($isDelete);
                array_push($options,$option);
            }

            $stmt->free_result();
        }
        else{
            print("数据库连接失败！");
        }
        return $options;
    }
}