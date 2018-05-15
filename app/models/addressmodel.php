<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class AddressModel extends AbstractModel
{
    public $id;
    public $address;
    public $add_id;
    private $tableName = "address";

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ".$this->tableName ." Where id = '$this->id' ";
        $stmt = $this->prepareStmt($query);

          if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->id = $row['id'];
                $this->address = $row['address'];
                $this->add_id = $row['add_id'];
            }
        }
       
    }

    Static function getCountry(){
        
        $sql = "SELECT * FROM address WHERE address in ('Egypt','egypt')";
        $stmt = self::prepareStmt($sql);
        $Types= array();
        $i=0;
        if($stmt->execute()){
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $AddressObj = new AddressModel($row['id']);
                $Types[$i] = $AddressObj; 
                $i++;
            }
            return $Types;
        }else{
            return false;
        }
       
    }

    Static function getCity($cityid){

        $sql = "SELECT * FROM address WHERE add_id = :cityid";
        $stmt = self::prepareStmt($sql);

        $cityid = self::test_input($cityid);  
      
        $stmt->bindParam(':cityid', $cityid, \PDO::PARAM_INT);         

        $Types= array();
        $i=0;
        if($stmt->execute()){
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $AddressObj = new AddressModel($row['id']);
            $Types[$i] = $AddressObj; 
            $i++;
            }
        }
        return $Types;
    }

    //check this fn
    public static function getByUser($userk)
    {
        $sql = 'SELECT * FROM address  WHERE user_id_fk = :userk ';
        $stmt = self::prepareStmt($sql);

        $userk = self::test_input($userk);  
      
        $stmt->bindParam(':userk', $userk, \PDO::PARAM_INT);         

        if ($stmt->execute() === true) {
            if(method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        }
        return false;
    }


    Static function InsertinDB($objUser)
    {
        $sql = "INSERT INTO address (address, add_id)
        VALUES (:address, :add_id)";
        
        $address = $objUser->address;
        $add_id = $objUser->add_id;

        $stmt = self::prepareStmt($sql);
        $address = self::test_input($address);  
        $add_id = self::test_input($add_id);

        $stmt->bindParam(':address', $address);  
        $stmt->bindParam(':add_id', $add_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}