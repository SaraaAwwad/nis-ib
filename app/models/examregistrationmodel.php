<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ExamRegistrationModel extends AbstractModel
{

    public $id;
    public $exam_id_fk;
    public $user_id_fk;

    protected static $tableName = 'exam_registration';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'exam_id_fk' => self::DATA_TYPE_INT,
        'user_id_fk' => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

}