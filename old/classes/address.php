<?php
	require_once("..\db\database.php");
    require_once("user.php");

class Address{
    //aggregation

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM address Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->address = $row['address'];
            $this->add_id = $row['add_id'];
        }
    }

    Static function InsertinDB($objUser)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO address (address, add_id)
        VALUES ('$objUser->address', '$objUser->add_id')";
        $dbobj->executesql2($sql);
    }

    function loadCountry(){
        $dbobj = new dbconnect;
        $output = '';
        $sql = "SELECT * FROM address WHERE address in ('Egypt','egypt')";
        $result = $dbobj->executesql2($sql);
        while ($row = mysqli_fetch_array($result))
        {
            $output = '<option value="'.$row['id'].'">'.$row['address'].'</option>'; 
        }
        echo $output;
    }


}
    
?>