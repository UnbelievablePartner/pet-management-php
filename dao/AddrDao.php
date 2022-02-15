<?php 
include_once dirname(__DIR__)."/concrete/Database.php";
include_once dirname(__DIR__)."/concrete/County.php";
include_once dirname(__DIR__)."/concrete/StreetOffice.php";
include_once dirname(__DIR__)."/concrete/Community.php";

class AddrDao extends Database
{
    public function getCounties($isDel){
        
        $counties = array ();

        if($this->open())
        {
            $sql = "select * from counties where isDelete=?";

            $stmt = $this->conn->prepare($sql);
            $stmt -> bind_param("i",$isDel);
            $stmt -> bind_result($id,$text,$isDelete);
            $stmt -> execute();

            while($stmt->fetch())
            {
                $county = new County();
                $county->setId($id);
                $county->setCounty($text);
                $county->setIsDelete($isDelete);
                array_push($counties,$county);
            }
            
            $stmt->free_result();
        }
        return $counties;
    }

    public function getStreetOfficesByCountyId($CountyId,$isDel){
        
        $streetOffices = array ();

        if($this->open())
        {
            $sql = "select * from streetoffices where ofcounty = ? and isDelete=?;";

            $stmt = $this->conn->prepare($sql);
            $stmt -> bind_param("si",$CountyId,$isDel);
            $stmt -> bind_result($id,$text,$ofStreetOffice,$isDelete);
            $stmt -> execute();

            while($stmt->fetch())
            {
                $streetOffice = new StreetOffice();
                $streetOffice->setId($id);
                $streetOffice->setStreetOffice($text);
                $streetOffice->setOfCounty($ofStreetOffice);
                $streetOffice->setIsDelete($isDelete);
                array_push($streetOffices,$streetOffice);
            }
            
            $stmt->free_result();
        }
        return $streetOffices;
    }

    public function getCommunitiesByStreetOfficeId($streetOfficeId,$isDel)
    {
        $communities = array();

        if($this->open())
        {
            $sql = "select * from communities where ofstreetoffice = ? and isDelete=?;";

            $stmt = $this->conn->prepare($sql);
            $stmt -> bind_param("si",$streetOfficeId,$isDel);
            $stmt -> bind_result($id,$text,$ofStreetOffice,$isDelete);
            $stmt -> execute();

            while($stmt->fetch())
            {
                $community = new Community();
                $community->setId($id);
                $community->setCommunity($text);
                $community->setOfStreetOffice($ofStreetOffice);
                $community->setIsDelete($isDelete);
                array_push($communities,$community);
            }
            
            $stmt->free_result();
        }
        return $communities;
    }
}