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

    Static function SelectAllCitiesInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from address where add_id = (SELECT id FROM address WHERE address in ('Egypt', 'egypt'))  order by address";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Address($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->address=$row["address"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }

    Static function SelectAllAreasInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from address where add_id in ((SELECT id FROM address WHERE add_id = (SELECT id FROM address WHERE address in ('Egypt', 'egypt')))) order by address";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Address($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->address=$row["address"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }

    Static function SelectAllStreetsInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from address where add_id in (Select id from address where add_id in (Select id from address where add_id=(Select id from address where address in ('Egypt', 'egypt')))) order by address";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Address($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->address=$row["address"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }
    Static function SelectCountryInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from address where address in ('Egypt', 'egypt')";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Address($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->address=$row["address"];
            $MyObj->address=$row["add_id"];
            $Result[$i]=$MyObj;
        }
        return $Result;
    }
    
}
    
?>