<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class RoomModel extends AbstractModel
{

    public $id;
    public $room_name;
    public $size;

    protected static $tableName = 'room';

    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'room_name' => self::DATA_TYPE_STR,
        'size' => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'id';


    public static function getFreeRooms($day, $slot, $semester)
    {
        //rooms that are free in that day - slot - semester,
        return self::getArr(
            'SELECT room.* FROM ' . self::$tableName . '
        WHERE  room.id NOT IN (SELECT room_id_fk
        FROM   schedule_details 
        INNER JOIN
        schedule ON schedule_details.sched_id_fk = schedule.id
        WHERE schedule.semester_id_fk= ' . $semester . ' AND schedule_details.day_id_fk = ' . $day . ' 
        AND schedule_details.slot_id_fk = ' . $slot . ' )  '
        );
        //check active
    }

    public static function getExamRooms($date, $slot)
    {
        return self::getArr(
            'SELECT room.* FROM room
        WHERE  room.id NOT IN (SELECT room_id_fk
        FROM   exam_details 
        WHERE  exam_details.date = "' . $date . '"
        AND exam_details.slot_id_fk = ' . $slot . ' ) '
        );

    }

}