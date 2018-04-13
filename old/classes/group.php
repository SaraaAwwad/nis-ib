<?php
	require_once("..\db\database.php");

class Group{

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM course_group Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->group_name = $row['group_name'];
        }
    }

    Static function getAllGroups(){
            $dbobj= new dbconnect;
            $sql = "SELECT * FROM course_group";
            $result = $dbobj->selectsql($sql);
            $Groups= array();
            $i=0;
            while ($row = mysqli_fetch_assoc($result)){
                $GroupObj = new Group($row['id']);
                $Groups[$i] = $GroupObj;
                $i++;
            }
            return $Groups;
        }

}
    
?>