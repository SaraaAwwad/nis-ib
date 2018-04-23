<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RegisterationModel{

    public $id;
    public $student_id;
    public $class_id;
    public $datetime;
    public $Semester_id_fk;

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
            $this->Semester_id_fk = $row['Semester_id_fk'];
            return $this;
        }
        return false;
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
    public function update(){
        $db = DatabaseHandler::getConnection();
        $sql = "UPDATE registration SET student_id_fk = '$this->student_id' ,class_id_fk=$this->class_id,
                datetime='$this->datetime', Semester_id_fk = $this->Semester_id_fk WHERE id='$this->id'";

        if (mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
            //die(mysqli_error($db));
        }
    }

}


?>