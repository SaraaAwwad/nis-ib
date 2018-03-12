<?php
	require_once("..\db\database.php");

class Status{

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM status Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->code = $row['code'];
        }
    }

    Static function getAllStatus(){
            $dbobj= new dbconnect;
            $sql = "SELECT * FROM status";
            $result = $dbobj->selectsql($sql);
            $Status= array();
            $i=0;
            while ($row = mysqli_fetch_assoc($result)){
                $StatusObj = new Status($row['id']);
                $Status[$i] = $StatusObj;
                $i++;
            }
            return $Status;
        }

}
    
?>