<?php
	require_once("..\db\database.php");
    require_once("user.php");
    require_once("salary.php");

class Currency{

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM currency Where id = '$id'";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->user_id_fk = $row['code'];
        }
    }

    Static function SelectCurrencyInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * FROM currency order by code";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Currency($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->code=$row["code"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }

}
    
?>