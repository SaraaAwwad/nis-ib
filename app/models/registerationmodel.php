<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RegisterationModel{

    public $id;
    public $student_id;
    public $class_id;
    public $datetime;

    public function __construct($id=""){

        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $sql = "SELECT * FROM registration";
        $db = DatabaseHandler::getConnection();
        $reginfo = mysqli_query($db,$sql);
        if($reginfo){
            $row = mysqli_fetch_array($reginfo);
            $this->id = $row['id'];
            $this->student_id = $row['student_id_fk'];
            $this->class_id = $row['class_id_fk'];
            $this->datetime = $row['datetime'];
        }
    }
    public static function getAll()
    {
        $sql = "SELECT * FROM registration";
        $db = DatabaseHandler::getConnection();
        $Reginfo = mysqli_query($db,$sql);
        $reg = array();
        $i=0;

        if($Reginfo){

            while($row = mysqli_fetch_array($Reginfo)){
                $regObj = new RegisterationModel($row['id']);
                $reg[$i] = $regObj;
                $i++;
            }
        }

        return $reg;
    }

}


?>