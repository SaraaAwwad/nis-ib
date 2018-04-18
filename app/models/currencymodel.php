<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class CurrencyModel{
    public $id;
    public $code;

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $sql = "SELECT * FROM currency Where id = '$id' ";
         $db = DatabaseHandler::getConnection();
        $userinfo = mysqli_query($db,$sql);
         if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->code = $row['code'];
        }
    }

    Static function getAll(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM currency";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $CurrencyObj = new CurrencyModel($row['id']);
            $Types[$i] = $CurrencyObj;
            $i++;
        }
        return $Types;
    }


}