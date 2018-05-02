<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class WeekdaysModel extends AbstractModel {

    public $id;
    public $day;

    //remove abstract if u dont need it ?
    protected static $tableName = 'weekdays';

    protected static $tableSchema = array(
        'id'                 => self::DATA_TYPE_INT,
        'day'               => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';


    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query="";
        $stmt = $this->prepareStmt($query);  

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);        
            $this->day = $row['day'];
        }
    }
}
