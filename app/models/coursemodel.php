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

            }
        }
      //  var_dump($this);
    }

    public static function getCourseByGrade($grade){
        //get all courses for this grade and active
        $sql = "SELECT course.* FROM course INNER JOIN status ON course.status = status.id
         WHERE group_id_fk = '.$grade.' AND status.code='active' ";
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

    public static function getByGrade($grade){
        //get all courses for this grade and active
        $sql = "SELECT course.* FROM course INNER JOIN status ON course.status = status.id
         WHERE group_id_fk = '.$grade.' AND status.code='active' 
         AND course.id NOT IN (SELECT course_id_fk FROM exam_details)";
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

    public static function getStudentsByCourse($grade){

        $sql = "SELECT user.* FROM user 
        INNER JOIN student_level ON user.id = student_level.user_id_fk 
        INNER JOIN status ON status.id = user.status 
        INNER JOIN registration ON registration.student_id_fk =user.id 
        AND scl_grade_id_fk = $grade AND status.code='active'";

        // $sql="SELECT user.id, user.fname, user.lname
        // From user inner JOIN registration ON registration.student_id_fk = user.id 
        // INNER JOIN schedule ON schedule.class_id_fk = registration.class_id_fk 
        // INNER JOIN schedule_details ON schedule_details.sched_id_fk = schedule.id 
        // AND schedule_details.course_id_fk = $course
        // AND schedule.semester_id_fk = registration.semester_id_fk 
        // WHERE user.status = (SELECT id FROM status WHERE code = 'active')";

        // select user.id, user.fname, user.lname
        //     From user inner JOIN registration on registration.student_id_fk = user.id 
        //     INNER JOIN schedule ON schedule.class_id_fk = registration.class_id_fk
        //     AND registration.semester_id_fk = schedule.semester_id_fk 
        //     AND schedule.semester_id_fk = $semester
        
        //     INNER JOIN student_level ON student_level.user_id_fk = user.id
        //     AND student_level.scl_grade_id_fk IN ('.$grade.')
        //     INNER JOIN schedule_details ON schedule.id = schedule_details.sched_id_fk
        //     AND schedule_details.course_id_fk IN ('.$course.')
        //     AND user.status = (SELECT id FROM status WHERE code = "active")'

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

    public static function getStudentCourses(){
        $query2='SELECT course.* , schedule.semester_id_fk from course inner join schedule_details on schedule_details.course_id_fk = course.id 
        inner join schedule on schedule_details.sched_id_fk = schedule.id inner join class on schedule.class_id_fk = class.id 
        inner join registration on registration.class_id_fk = class.id where registration.student_id_fk = 7';

        
        $stmt = self::prepareStmt($query2);  
        $Res = array();
        $i=0;
        
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){ 
                $st = new CourseModel($row['id']);
                $st->semester_id_fk = $row['semester_id_fk'];
                $Res[$i] = $st;
                $i++;     
            }
        }

        return $Res;
    }
    
}
