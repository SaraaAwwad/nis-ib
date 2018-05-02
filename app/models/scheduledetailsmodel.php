<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ScheduleDetailsModel extends AbstractModel {

public $id;
public $sched_id_fk;
public $course_id_fk;
public $slot_id_fk;
public $day_id_fk;
public $teacher_id_fk;
public $room_id_fk;

protected static $tableName = 'schedule_details';
protected static $tableSchema = array(
    'id'                     => self::DATA_TYPE_INT,
    'sched_id_fk'            => self::DATA_TYPE_INT,
    'course_id_fk'           => self::DATA_TYPE_INT,
    'slot_id_fk'             => self::DATA_TYPE_INT,
    'day_id_fk'              => self::DATA_TYPE_INT,
    'teacher_id_fk'          => self::DATA_TYPE_INT,
    'room_id_fk'             => self::DATA_TYPE_INT
);

protected static $primaryKey = 'id';

public static function getDetails($sched_id)
{
    return self::get(
    'SELECT schedule_details.*, course.course_code, slot.slot_name, weekdays.day, user.fname, user.lname, room.room_name
    FROM ' . self::$tableName . ' INNER JOIN
    schedule ON schedule_details.sched_id_fk = schedule.id
    INNER JOIN course ON schedule_details.course_id_fk = course.id
    INNER JOIN slot ON schedule_details.slot_id_fk = slot.id
    INNER JOIN weekdays ON schedule_details.day_id_fk = weekdays.id
    INNER JOIN user ON schedule_details.teacher_id_fk = user.id
    INNER JOIN room ON schedule_details.room_id_fk = room.id
    WHERE schedule_details.sched_id_fk = '.$sched_id.' 
    ORDER BY weekdays.id, slot.id'
    );
}


public static function getDet($sched_id){
    $query = 'SELECT schedule_details.*, course.course_code, slot.slot_name, weekdays.day, user.fname, user.lname, room.room_name
    FROM schedule_details INNER JOIN
    schedule ON schedule_details.sched_id_fk = schedule.id
    INNER JOIN course ON schedule_details.course_id_fk = course.id
    INNER JOIN slot ON schedule_details.slot_id_fk = slot.id
    INNER JOIN weekdays ON schedule_details.day_id_fk = weekdays.id
    INNER JOIN user ON schedule_details.teacher_id_fk = user.id
    INNER JOIN room ON schedule_details.room_id_fk = room.id
    WHERE schedule_details.sched_id_fk = '.$sched_id.' 
    ORDER BY weekdays.id, slot.id';

    $stmt = self::prepareStmt($query);  
    $details = array();
    $i=0;

    if($stmt->execute()){
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $s = new ScheduleDetailsModel("");
            $s->sched_id_fk = $row['sched_id_fk'];
            $s->course_id_fk = $row['course_id_fk'];
            $s->slot_id_fk = $row['slot_id_fk'];
            $s->day_id_fk = $row['day_id_fk'];
            $s->teacher_id_fk = $row['teacher_id_fk'];
            $s->room_id_fk = $row['room_id_fk'];
            $s->course_code = $row['course_code'];
            $s->slot_name = $row['slot_name'];
            $s->day = $row['day'];
            $s->fname = $row['fname'];
            $s->lname = $row['lname'];
            $s->room_name = $row['room_name'];
            $details[$i] = $s;
            $i++;
        }
        
    }
    return $details;
}

}
