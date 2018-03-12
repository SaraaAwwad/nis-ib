<?php
    require_once("\..\db\database.php");

    class Schedule {
        
        public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM schedule Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->section_id = $row['section_id'];
            $this->room_id = $row['room_id'];
            $this->day_id_fk = $row['day_id_fk'];
            $this->slot_id_fk = $row['slot_id_fk'];
        }
    }

    Static function InsertinDB($id,$objSection)
    {
        $dbobj = new dbconnect;
        $sql1 = "INSERT INTO schedule (section_id, room_id, day_id_fk, slot_id_fk) VALUES ('$id', '$objSection->room','$objSection->day','$objSection->slot')";
        $dbobj->executesql($sql1);
    }

        Static function SelectAllSchedulesInDB($id)
        {
        $dbobj = new dbconnect;
        $sql="SELECT schedule.*, room.*, slot.slot_name, weekdays.* FROM schedule INNER JOIN room ON schedule.room_id = room.id INNER JOIN weekdays ON schedule.day_id_fk = weekdays.id INNER JOIN slot ON schedule.slot_id_fk = slot.id Where schedule.section_id = '$id' ORDER BY schedule.id";

        $result = $dbobj->executesql2($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Schedule($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->section_id = $row["section_id"];
            $MyObj->name=$row["name"];
            $MyObj->size=$row["size"];
            $MyObj->day=$row["day"];
            $MyObj->slot_name=$row["slot_name"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
        }

    }
     
?>
