<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ExamModel extends AbstractModel{

    public $id;
    public $grade_id_fk ;
    public $course_id_fk ;
    public $slot_id_fk;
    public $day_id_fk ;
    public $room_id_fk ;
    public $date;
    public $status_id_fk;
    public $semester_id_fk;
    public $OutOfGrade;
    
    protected static $tableName = 'exam_details';

    protected static $tableSchema = array(
        'id'                         => self::DATA_TYPE_INT,
        'grade_id_fk'                => self::DATA_TYPE_INT,
        'course_id_fk'               => self::DATA_TYPE_INT,
        'slot_id_fk'                 => self::DATA_TYPE_INT,
        'day_id_fk'                  => self::DATA_TYPE_INT,
        'room_id_fk'                 => self::DATA_TYPE_INT,
        'date'                       => self::DATA_TYPE_DATE,
        'semester_id_fk'             => self::DATA_TYPE_INT,
        'status_id_fk'               => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

    public static function getExams()
    {
        return self::get(
            'SELECT exam_details.*, scl_grade.grade_name, semester.year, season.season_name, status.code, weekdays.day,
         slot.slot_name, room.room_name, course.name
         FROM ' . self::$tableName . ' 
         INNER JOIN scl_grade ON exam_details.grade_id_fk = scl_grade.id
         INNER JOIN status ON exam_details.status_id_fk = status.id
         INNER JOIN semester ON exam_details.semester_id_fk = semester.id
         INNER JOIN season ON semester.season_id_fk = season.id 
         INNER JOIN weekdays ON exam_details.day_id_fk = weekdays.id
         INNER JOIN room ON exam_details.room_id_fk = room.id 
         INNER JOIN slot ON exam_details.slot_id_fk = slot.id
         INNER JOIN course ON exam_details.course_id_fk = course.id'
        );
    }

    public function isExist(){
        return self::get(
            'SELECT * FROM ' . self::$tableName . '
            WHERE grade_id_fk = '.$this->grade_id_fk.' AND 
            semester_id_fk = '.$this->semester_id_fk .' '
        );
    }

    public static function getStudentsInCourse($course,$exam){
        return self::getArr(
            'select user.id, user.fname, user.lname
            From user inner JOIN registration on registration.student_id_fk = user.id 
            INNER JOIN schedule ON schedule.class_id_fk = registration.class_id_fk
            AND registration.semester_id_fk = schedule.semester_id_fk
            INNER JOIN student_level ON student_level.user_id_fk = user.id
            AND student_level.scl_grade_id_fk IN ('.$exam.')
            INNER JOIN schedule_details ON schedule.id = schedule_details.sched_id_fk
            AND schedule_details.course_id_fk IN ('.$course.')
            AND user.status = (SELECT id FROM status WHERE code = "active")');
    }

    public static function getDates($students){

        return self::getArr(
            'SELECT exam_details.* FROM exam_details 
            INNER JOIN exam_registration ON exam_details.id = exam_registration.exam_id_fk 
            WHERE exam_registration.user_id_fk IN ('.$students.') ');
    }


    public static function getOutOfGrade($course, $semester){
        $query = "select * from exam_details where course_id_fk = :course AND semester_id_fk = :semester";
        $stmt = self::prepareStmt($query);
        
        $stmt->bindParam(":course", $course);
        $stmt->bindParam(":semester", $semester);

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $grade = $row['OutOfGrade'];
            return $grade;
        }else{
            return false;
        }
    }
//    public static function getSlots($students,$day,$date){
//
//        return self::getArr(
//            'SELECT slot.* FROM slot
//                 WHERE  slot.id NOT IN (SELECT slot_id_fk
//                 FROM   exam_details
//                 INNER JOIN
//                 exam_registration ON exam_details.id = exam_registration.exam_id_fk
//                 WHERE exam_registration.user_id_fk IN ('.$students.')
//                 AND exam_details.day_id_fk = '.$day.'
//                 AND exam_details.date = "' . $date . '" ) ' );  }


}