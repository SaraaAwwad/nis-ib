<?php
    require_once("..\db\database.php");

class UserType
{
	public $id;
	public $title;
	public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM user_type Where id = '$id'";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->user_id_fk = $row['title'];
        }
    }

  Static function SelectProfessionsInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from user_type";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Address($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->title=$row["title"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }
}

?>