<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class LevelModel{

    // public $id; //scl_level id
    public $level;
    // public $grd_id; //scl_grade id
    // public $scl_level_id_fk;
    // public $scl_grade_id_fk;
    // public $user_id_fk;
    // public $stlvl_id;//student_level id
    // public $grade;
    public $id;
    public $gr_id;
    public $gr_id_fk;
    public $lev_id;
    public $lev_id_fk;
    public $user_id_fk;

    public function __construct($id="")
    {

            if($id != ""){

                $this->getInfo($id);
        }
    }

    

    public static function getAll()
    {

        $sql = "SELECT * FROM scl_level";
        $db = DatabaseHandler::getConnection();
        $levelinfo = mysqli_query($db,$sql);
        $Levels = array();
        $i=0;

        if($levelinfo){

            while($row = mysqli_fetch_array($levelinfo)){

                $Levels[$i] = new LevelModel();
                $Levels[$i]->id = $row['id'];
                $Levels[$i]->level = $row['level'];
                $i++; 
            }
        }

            return $Levels;
    }

    public static function insertInDb($level){

        $db = DatabaseHandler::getConnection();
        $level->user_id_fk = mysql_insert_id();

        $sql = "INSERT INTO student_level WHERE student_level.user_id_fk = user.id 
        VALUES ('$level->lev_id_fk', '$level->gr_id_fk','$level->user_id_fk')";
        
    }

}