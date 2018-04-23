<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StaffModel extends AbstractModel {

    public $id;
    public $type_id;
    public $fname;
    public $lname;
    public $gender;
    public $DOB;
    public $username;
    public $pwd;
    public $email;
    public $status;
    public $img;
    public $user_id_fk;
    public $add_id_fk;
    public $phone;

    protected static $tableName = 'user';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'type_id'             => self::DATA_TYPE_INT,
        'fname'               => self::DATA_TYPE_STR,
        'lname'               => self::DATA_TYPE_STR,
        'gender'              => self::DATA_TYPE_STR,
        'DOB'                 => self::DATA_TYPE_DATE,
        'username'            => self::DATA_TYPE_STR,
        'pwd'                 => self::DATA_TYPE_STR,
        'email'               => self::DATA_TYPE_STR,
        'status'              => self::DATA_TYPE_INT,
        'img'                 => self::DATA_TYPE_STR,
        'user_id_fk'          => self::DATA_TYPE_INT,
        'add_id_fk'           => self::DATA_TYPE_INT,
        'phone'               => self::DATA_TYPE_INT,
    );
    protected static $primaryKey = 'id';

    public static function getUsers()
    {
        return self::get(
        'SELECT user.*, user_type.title, salary.amount, status.code, telephone.number FROM ' . self::$tableName .
         ' INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN salary ON user.id = salary.user_id_fk 
         INNER JOIN status ON user.status = status.id INNER JOIN telephone ON user.id = telephone.user_id_fk 
         where title NOT IN ("student","parent")'
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
