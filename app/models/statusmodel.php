<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StatusModel{
    public $id;
    public $code;

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $sql = "SELECT * FROM status Where id = '$id' ";
        $db = DatabaseHandler::getConnection();
        $statusinfo = mysqli_query($db,$sql);
        
        if($statusinfo){
            $row = mysqli_fetch_array($statusinfo);
            $this->id = $row['id'];
            $this->code = $row['code']; 
        }
    }

    public static function getAll(){
        $sql = "SELECT * FROM status";
        $db = DatabaseHandler::getConnection();
        $statusinfo = mysqli_query($db,$sql);
        
        $Stat = array();
        $i=0;

        if($statusinfo){
            while($row = mysqli_fetch_array($statusinfo)){
                $Stat[$i] = new StatusModel();
                $Stat[$i]->id = $row['id'];
                $Stat[$i]->code = $row['code'];
                $i++; 
            }
        }
    return $Stat;
    }
}