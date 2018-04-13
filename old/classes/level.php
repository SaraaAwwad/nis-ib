<?php
	require_once("..\db\database.php");

class Level{

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM scl_level Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->level = $row['level'];
        }
    }

    Static function getAllLevel(){
            $dbobj= new dbconnect;
            $sql = "SELECT * FROM scl_level";
            $result = $dbobj->selectsql($sql);
            $Levels= array();
            $i=0;
            while ($row = mysqli_fetch_assoc($result)){
                $LevelObj = new Level($row['id']);
                $Levels[$i] = $LevelObj;
                $i++;
            }
            return $Levels;
        }

}
    
?>