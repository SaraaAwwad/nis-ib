<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseModel extends AbstractModel {

    public $id;
    public $course_code;
    public $descr;
    public $status;
    public $group_id_fk;
    public $level_id_fk;
    public $name;
    public $teaching_hours;
    public $group;

    protected static $tableName = 'course';
    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'name'               => self::DATA_TYPE_STR,
        'course_code'        => self::DATA_TYPE_STR,
        'descr'              => self::DATA_TYPE_STR,
        'level_id_fk'        => self::DATA_TYPE_INT,
        'teaching_hours'     => self::DATA_TYPE_INT,
        'group_id_fk'        => self::DATA_TYPE_INT,
        'status'             => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'id';

    public static function getCourse() {
        return self::get(
        'SELECT course.*, course_group.id, scl_level.id FROM ' . self::$tableName . ' INNER JOIN course_group ON course.group_id_fk = course_group.id INNER JOIN scl_level ON course.level_id_fk = scl_level.id'
        );
    }

    public static function insertInDB($course){

        $db = DatabaseHandler::getConnection();

        $sql = "INSERT INTO course ('name', 'course_code', 'descr, level_id_fk', 'group_id_fk', 'status', 'teaching_hours') 
        VALUES ('$course->name','$course->course_code', '$course->descr', '$course->level_id_fk',
        '$course->group_id_fk', '$course->status', '$course->teaching_hours' )";

        if (mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
        // die(mysqli_error($db));
        }
    }

    public function __construct($id=""){
		if($id != ""){
            $this->id = $id;
			$this->getInfo();
		}
    }

    public function getInfo(){
        $query = "SELECT * FROM course Where id = '$this->id' ";
        $stmt = $this->prepareStmt($query);

          if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){

                $this->id=$row["id"];
                $this->name = $row["name"];
                $this->course_code = $row["course_code"];
                $this->descr = $row["descr"];
                $this->level_id_fk = $row["level_id_fk"]; //no use
                $this->teaching_hours = $row["teaching_hours"];
                $this->group_id_fk = $row["group_id_fk"];
                $this->group = new CourseGroupModel($this->group_id_fk);
                $this->status = $row["status"];

                //
            }
        }
      //  var_dump($this);
    }

    public static function getCourseByGrade($grade_id_fk)
    {
        //get all courses for this grade and active
        $sql = "SELECT course.* FROM course INNER JOIN status ON course.status = status.id
         WHERE group_id_fk = $grade_id_fk AND status.code='active' ";
        $stmt = self::prepareStmt($sql);
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){  
                $courseObj = new CourseModel($row['id']);
                $Res[$i] = $courseObj;
                $i++;
            }
        }
        return $Res;
    }

    public static function getStudentsByCourse($course, $semester){

        $sql = 'SELECT user.id, user.fname, user.lname
        From user inner JOIN registration on registration.student_id_fk = user.id 
        INNER JOIN schedule on schedule.class_id_fk = registration.class_id_fk 
        INNER JOIN schedule_details ON schedule_details.sched_id_fk = schedule.id 
        AND schedule_details.course_id_fk = ' .$course. '
        INNER JOIN semester ON schedule.semester_id_fk = ' .$semester. '
        AND schedule.semester_id_fk = registration.semester_id_fk 
        WHERE user.status = (SELECT id FROM status WHERE code = "active")';

        $stmt = self::prepareStmt($sql);  

        $Res = array();
        $i=0;
        
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){  
                $st = new CourseModel($row['id']);
                $Res[$i] = $st;
                $i++;
               //var_dump($st);
            }
        }
        //var_dump($Res);
        //exit();
        return $Res;

    }
    
}
