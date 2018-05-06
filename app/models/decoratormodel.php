<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class DecoratorModel extends AbstractModel
{
    public $id;
    public $name;

    protected static $tableName = 'decorator';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){

        $query = "SELECT * FROM ". self::$tableName ." Where id = '$this->id' ";
        $stmt = DatabaseHandler::getConnection()->prepare($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->name = $row['name'];
            }
        }
    }


}
?>