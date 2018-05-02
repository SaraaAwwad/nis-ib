<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class WeekdaysModel extends AbstractModel {

    public $id;
    public $day;

    protected static $tableName = 'weekdays';

    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'day'               => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

//    public static function getAvailableDays($semester,$user){
//        return self::getArr('
//        SELECT weekdays.* FROM weekdays
//        WHERE  weekdays.id NOT IN (SELECT day_id_fk
//        FROM   exam_details
//        INNER JOIN exam_registration
//        ON exam_details.id = exam_registration.exam_id_fk
//        WHERE exam_details.semester_id_fk= '.$semester.'
//        AND exam_registration.user_id_fk = '.$user.')
//        '
//        );
//    }



}
