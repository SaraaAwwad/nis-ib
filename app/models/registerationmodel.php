<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RegisterationModel extends AbstractModel{

    public $id;
    public $student_id;
    public $class_id;
    public $datetime;
    public $Semester_id_fk;

    protected static $tableName = 'registration';

    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'student_id_fk'               => self::DATA_TYPE_INT,
        'class_id_fk'          => self::DATA_TYPE_INT,
        'semester_id_fk'           => self::DATA_TYPE_INT,
        'datetime'  =>        self::DATA_TYPE_DATE
    );
    protected static $primaryKey = 'id';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getReg();
        }
    }

    public static function getReg(){
        $query = "SELECT registration.* , user.fname, user.lname, class.name, season.season_name, semester.year FROM registration INNER JOIN
        class ON registration.class_id_fk = class.id INNER JOIN semester ON registration.semester_id_fk = semester.id INNER JOIN season on season.id = semester.season_id_fk INNER JOIN user ON registration.student_id_fk = user.id";
        $stmt = self::prepareStmt($query);
        $reg = array();
        $i=0;  
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){

            $reg[$i] = new RegisterationModel();
            
            $reg[$i]->id = $row['id'];
            $reg[$i]->fname = $row['fname'];
            $reg[$i]->lname = $row['lname'];
            $reg[$i]->name = $row['name'];
            $reg[$i]->season_name = $row['season_name'];
            $reg[$i]->year = $row['year'];
            $reg[$i]->datetime = $row['datetime'];
            $i++;

            }
        }
        return $reg;
    }



    public static function deleteReg($id){
        $query = "DELETE FROM registration WHERE id = :id";
        $stmt = self::prepareStmt($query);

        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>