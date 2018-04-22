<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CourseGroupModel extends AbstractModel {

    public $id;
    public $group_name;

    protected static $tableName = 'course_group';
    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'group_name'         => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'id';

    public static function getAll()
    {
        $sql = "SELECT * FROM course_group";
        $db = DatabaseHandler::getConnection();
        $grp = mysqli_query($db,$sql);
        $group = array();
        $i = 0;
        
        if($grp){
            while($row = mysqli_fetch_array($grp)){
                $group[$i] = new CourseGroupModel();
                $group[$i]->id = $row['id'];
                $group[$i]->group_name = $row['group_name'];
                $i++;
            }
        }
                return $group;
    }
}
