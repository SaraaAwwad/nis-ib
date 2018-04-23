<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ScheduleModel extends AbstractModel {

    public $id;
    public $semester_id_fk;
    public $class_id_fk ;
    public $status_id_fk;

    public $sched_details ;

    protected static $tableName = 'schedule';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'class_id_fk'               => self::DATA_TYPE_INT,
        'semester_id_fk'          => self::DATA_TYPE_INT,
        'status_id_fk'   => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'id';

    public static function getSchedules()
    {
        return self::get(
        'SELECT schedule.*, class.name, semester.year, season.season_name, status.code  FROM ' . self::$tableName . ' INNER JOIN
          class ON schedule.class_id_fk = class.id
         INNER JOIN status ON schedule.status_id_fk = status.id
         INNER JOIN semester ON schedule.semester_id_fk = semester.id
         INNER JOIN season ON semester.season_id_fk = season.id '
        );
    }

    public function getDetails(){
       $this->sched_details = ScheduleDetailsModel::getDetails($this->id);
    }

    public function isExist(){
        return self::get(
            'SELECT * FROM ' . self::$tableName . '
            WHERE class_id_fk = '.$this->class_id_fk.' AND 
            semester_id_fk = '.$this->semester_id_fk .' '
        );
    }

    public function getFreeDays($slot){
        return self::getArr(
            'SELECT weekdays.* FROM weekdays
            WHERE  weekdays.id NOT IN (SELECT day_id_fk
            FROM  schedule_details
            WHERE sched_id_fk = '.$this->id.'
            AND slot_id_fk = '.$slot.' )  '
        );
    }
}
