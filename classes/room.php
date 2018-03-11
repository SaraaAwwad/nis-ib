<?php
    require_once("..\db\database.php");

class Room{

    public $id;
    public $roomName;
    public $roomSize;
    private $db_obj;

    public function __construct($id=""){
        $this->db_obj= new dbconnect();
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){

        $sql = "SELECT * FROM room Where id = '$id' ";
        $info = $this->db_obj->selectsql($sql);
        if($info){
            $row = mysqli_fetch_array($info);
            $this->id = $row['id'];
            $this->roomName = $row['name'];
            $this->roomSize = $row['size'];
            }

        }

    static function getRoom(){

        $dbobj= new dbconnect;
        $sql = "SELECT * FROM room";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $roomsArr = array();
        while ($row = mysqli_fetch_assoc($result)){
            
            $roomObj = new Room($row['id']);
            $roomsArr[$i]= $roomObj;
        $i++;

        }
        return $roomsArr;

    }

}
   