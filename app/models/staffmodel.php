<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StaffModel extends UserModel{

    public static function getUsers()
    {
        return self::get(
        'SELECT user.*, user_type.title, salary.amount, status.code FROM ' . self::$tableName .
         ' INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN salary ON user.id = salary.user_id_fk 
         INNER JOIN status ON user.status = status.id where title NOT IN ("UserTypesModel::STUDENT","UserTypesModel::PARENT") ORDER BY user.id ASC'
        );
    }

    public static function getFreeTeachers($day, $slot, $semester_id_fk){
        
        return self::getArr(
            'SELECT user.* FROM '.self::$tableName.'
            INNER JOIN user_type ON user.type_id = user_type.id
            INNER JOIN status ON status.id = user.status
            WHERE status.code="active" AND 
            user_type.title = "teacher" AND 
            user.id NOT IN (SELECT teacher_id_fk
            FROM   schedule_details 
            INNER JOIN
            schedule ON schedule_details.sched_id_fk = schedule.id
            WHERE schedule.semester_id_fk= '.$semester_id_fk.' AND schedule_details.day_id_fk = '.$day.' 
            AND schedule_details.slot_id_fk = '.$slot.' )  '
        );
    }

    public function cryptPassword($password)
    {
        $this->pwd = crypt($password, APP_SALT);
    }


}
