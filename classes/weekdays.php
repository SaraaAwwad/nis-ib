<?php
    require_once("..\db\database.php");

class Weekdays{

    public $id;
    public $day_name;
    private $db_obj;

    public function __construct($id=""){
        $this->db_obj= new dbconnect();
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){

        $sql = "SELECT * FROM weekdays Where id = '$id' ";
        $info = $this->db_obj->selectsql($sql);
        if($info){
            $row = mysqli_fetch_array($info);
            $this->id = $row['id'];
            $this->day_name = $row['day'];
            }

        }

    static function getWeekdays(){

        $dbobj= new dbconnect;
        $sql = "SELECT * FROM weekdays";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $daysArr = array();
        while ($row = mysqli_fetch_assoc($result)){
            
            $weekdaysObj = new Weekdays($row['id']);
            $daysArr[$i]= $weekdaysObj;
        $i++;

        }
        return $daysArr;

    }

}
   