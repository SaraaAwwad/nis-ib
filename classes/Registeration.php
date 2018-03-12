<?php
	require_once("..\db\database.php");

    class Registeration {
       public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM registration Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->student_id = $row['student_id'];
            $this->semester_id = $row['semester_id'];
            $this->datetime = $row['datetime'];
        }
    }

    Static function InsertinDB($cid,$Reg)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO registration_details (reg_id_fk, section_id_fk) VALUES ('$Reg', '$cid')";
        $dbobj->executesql($sql);
    }


    }
    
    ?>
