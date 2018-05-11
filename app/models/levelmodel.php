<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class LevelModel extends AbstractModel{

    // public $id; //scl_level id
    public $level;
    // public $grd_id; //scl_grade id
    // public $scl_level_id_fk;
    public $scl_grade_id_fk;
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
        $stmt = self::prepareStmt($sql);
        $Levels = array();
        $i=0;

        // $db = DatabaseHandler::getConnection();
        // $levelinfo = mysqli_query($db,$sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $Levels[$i] = new LevelModel();
                $Levels[$i]->id = $row['id'];
                $Levels[$i]->level = $row['level'];
                $i++;

            }
        }

        return $Levels;
           
    }

    public static function insertInDb($level){


        $sql = "INSERT INTO student_level WHERE student_level.user_id_fk = user.id 
        VALUES (:scl_grade_id_fk, :user_id_fk)";

        $stmt = self::prepareStmt($sql);

        //$stm->bindParam(':lev_id_fk', $this->lev_id_fk,\PDO::PARAM_INT);
        $stm->bindParam(':scl_grade_id_fk', $this->scl_grade_id_fk, \PDO::PARAM_INT);
        $stm->bindParam(':user_id_fk', $this->user_id_fk, \PDO::PARAM_INT);
        
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}