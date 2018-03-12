<?php
    require_once("..\db\database.php");

class Slot{

    public $id;
    public $slotName;
    public $startTime;
    public $endTime;
    private $db_obj;

    public function __construct($id=""){
        $this->db_obj= new dbconnect();
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){

        $sql = "SELECT * FROM slot Where id = '$id' ";
        $info = $this->db_obj->selectsql($sql);
        if($info){
            $row = mysqli_fetch_array($info);
            $this->id = $row['id'];
            $this->slotName = $row['slot_name'];
            $this->startTime = $row['start_time'];
            $this->endTime = $row['end_time'];
        
            }

        }

    static function getSlots(){

        $dbobj= new dbconnect;
        $sql = "SELECT * FROM slot";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $SlotsArr = array();
        while ($row = mysqli_fetch_assoc($result)){
            
            $SlotObj = new Slot($row['id']);
            $SlotsArr[$i]= $SlotObj;
            
            $i++;

        }
        return $SlotsArr;
    }

    Static function SelectAvailableSlots()
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from slot where id NOT IN (Select slot_id_fk from schedule)";
        $result = $dbobj->executesql2($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Slot($row["id"]);
            $MyObj->id = $row['id'];
            $MyObj->slotName = $row['slot_name'];
            $MyObj->startTime = $row['start_time'];
            $MyObj->endTime = $row['end_time'];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }


}
   ?>