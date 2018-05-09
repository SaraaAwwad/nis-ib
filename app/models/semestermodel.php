<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;
class SemesterModel extends AbstractModel{
    public $id;
    public $year;
    public $season_id_fk;
    public $start_date;
    public $end_date;
    public $season_name;
    protected static $tableName = 'semester';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'year'               => self::DATA_TYPE_INT,
        'season_id_fk'          => self::DATA_TYPE_INT,
        'start_date'           => self::DATA_TYPE_DATE,
        'end_date'           => self::DATA_TYPE_DATE        
    );
    protected static $primaryKey = 'id';
    public static function getSemesters(){
        return self::get(
        'SELECT semester.*, season.season_name FROM ' . self::$tableName . ' INNER JOIN
          season ON semester.season_id_fk = season.id'
        );
    }

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }
    public function getInfo(){
        $query = "SELECT semester.*, season.season_name FROM semester INNER JOIN
        season ON semester.season_id_fk = season.id";
        $stmt = $this->prepareStmt($query);  
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->year = $row['year'];
            $this->season_name = $row['season_name'];
            $this->start_date = $row['start_date'];
            $this->end_date = $row['end_date'];
        }
        //$this->getFees();
    }

    public static function getSemestersByCourse($course){
        $sql = "SELECT DISTINCT semester.* from semester
        INNER JOIN schedule ON schedule.semester_id_fk = semester.id INNER JOIN 
        schedule_details ON schedule_details.sched_id_fk = schedule.id 
        INNER JOIN course ON schedule_details.course_id_fk = '$course'";
        $stmt = self::prepareStmt($sql);
        $sem = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $se = new SemesterModel($row['id']);
                $sem[$i] = $se;
                $i++;
            }
        }
        return $sem;
    }


}