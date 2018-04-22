<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class AddressModel{
    public $id;
    public $address;
    public $add_id;

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $sql = "SELECT * FROM address Where id = '$id' ";
         $db = DatabaseHandler::getConnection();
        $userinfo = mysqli_query($db,$sql);
         if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->address = $row['address'];
            $this->add_id = $row['add_id'];
        }
    }

    Static function getCountry(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM address WHERE address in ('Egypt','egypt')";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $AddressObj = new AddressModel($row['id']);
            $Types[$i] = $AddressObj; 
            $i++;
        }
        return $Types;
    }

    Static function getCity($cityid){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM address WHERE add_id = '" . $cityid . "'";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $AddressObj = new AddressModel($row['id']);
            $Types[$i] = $AddressObj; 
            $i++;
        }
        return $Types;
    }

    public static function getByUser($userk)
    {
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE user_id_fk = "' . $userk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
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
        $db = DatabaseHandler::getConnection();
        $sql = "INSERT INTO address (address, add_id)
        VALUES ('$objUser->address', '$objUser->add_id')";
        $dbobj->executesql2($sql);
    }

}