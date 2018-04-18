<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class LevelModel{
    public $id;
    public $level;

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    

    public static function getAll(){
        $sql = "SELECT * FROM scl_level";
        $db = DatabaseHandler::getConnection();
        $levelinfo = mysqli_query($db,$sql);
        
        $Levels = array();
        $i=0;

        if($levelinfo){
            while($row = mysqli_fetch_array($levelinfo)){
                $Levels[$i] = new LevelModel();
                $Levels[$i]->id = $row['id'];
                $Levels[$i]->level = $row['level'];
                $i++; 
            }
        }
    return $Levels;
    }
}