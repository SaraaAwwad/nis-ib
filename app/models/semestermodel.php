<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class SemesterModel extends AbstractModel {

    public $id;
    public $year;
    public $season_id_fk;
    public $start_date;
    public $end_date;

    protected static $tableName = 'semester';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'year'               => self::DATA_TYPE_INT,
        'season_id_fk'          => self::DATA_TYPE_INT,
        'start_date'           => self::DATA_TYPE_DATE,
        'end_date'           => self::DATA_TYPE_DATE        
    );

    protected static $primaryKey = 'id';

    public static function getSemesters()
    {
        return self::get(
        'SELECT semester.*, season.season_name FROM ' . self::$tableName . ' INNER JOIN
          season ON semester.season_id_fk = season.id'
        );
    }

    public static function getSemestersByCourse($grade, $course){
        // $sql = "SELECT semester.*,season.season_name, course.group_id_fk,
        // schedule.semester_id_fk, 
        // schedule_details.course_id_fk FROM semester
        // INNER JOIN season ON semester.season_id_fk = season.id 
        // INNER JOIN schedule ON schedule.semester_id_fk = semester.id 
        // INNER JOIN schedule_details ON schedule_details.sched_id_fk = schedule.id
        // INNER JOIN course ON course.group_id_fk = $grade 
        // WHERE schedule_details.course_id_fk = $course";

        $sql = "SELECT semester.*, season.season_name FROM semester 
        INNER JOIN season ON semester.season_id_fk = season.id 
        INNER JOIN schedule ON schedule.semester_id_fk = semester.id 
        INNER JOIN schedule_details ON schedule_details.sched_id_fk = schedule.id 
        INNER JOIN course ON schedule_details.course_id_fk = $course AND course.group_id_fk = $grade";
        $stmt = self::prepareStmt($sql);
        $sem = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $se[$i] = new SemesterModel($row['id']);
                // $sem[$i]->id = $row['id'];
                // $sem[$i]->season_name = $row['season_name'];
                // $sem[$i]->year = $row['year'];
                // $se = new CourseModel($row['id']);
                $sem[$i] = $se;
                $i++;
            }
        }
        return $sem;
        }
    }


