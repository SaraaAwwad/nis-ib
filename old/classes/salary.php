<?php
	require_once("..\db\database.php");
    require_once("user.php");
class Salary{

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }
    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM salary Where id = '$id'";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->user_id_fk = $row['user_id_fk'];
            $this->amount = $row['amount'];
            $this->currency_id = $row['currency_id'];
        }
    }
}
    
?>