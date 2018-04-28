<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ExamDetailsModel extends AbstractModel
{

    public $id;
    public $exam_id_fk;
    public $course_id_fk;
    public $slot_id_fk;
    public $day_id_fk;
    public $room_id_fk;

    protected static $tableName = 'exam_details';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'exam_id_fk' => self::DATA_TYPE_INT,
        'course_id_fk' => self::DATA_TYPE_INT,
        'slot_id_fk' => self::DATA_TYPE_INT,
        'day_id_fk' => self::DATA_TYPE_INT,
        'room_id_fk' => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

}