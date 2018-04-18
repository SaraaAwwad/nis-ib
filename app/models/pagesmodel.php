<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PagesModel{
    public $id;
	public $friendlyname;
	public $physicalname;
	public $html;
	public $pageid;
    public $status_id_fk;
    public $status;
    public $parent;
    public $publisher;
    
    public function __construct($id=""){
		if($id != ""){
			$this->getInfo($id);
		}
    }

    public static function getAll(){ 

        $db = DatabaseHandler::getConnection();
        $sql ="SELECT * FROM pages";
        $result = mysqli_query($db,$sql);
        $Res = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new PagesModel($row['id']);
            $Res[$i]=$MyObj;
            $i++;
        }
        return $Res;
    }

    public static function insertPage($friendlyname, $physicalname, $status_id, $parentid, $html){
        $db = DatabaseHandler::getConnection();
        $sql = "INSERT INTO pages (friendlyname, physicalname, status_id_fk, pageid, HTML, layout_id_fk) 
        VALUES ('$friendlyname', '$physicalname', '$status_id', '$parentid', '$html', 1)";

        if (mysqli_query($db, $sql)){
            return true;
        }else{
          //  return false;
         die(mysqli_error($db));
        }
    }

    public static function getAllParentPages(){
        
    }

    public function getInfo($id){
        $db = DatabaseHandler::getConnection();
        $sql ="SELECT * FROM pages WHERE id = '$id' ";
        $result = mysqli_query($db,$sql);
        $Res = array();
        $i=0;
        if($result){
            while ($row = mysqli_fetch_assoc($result))
            {
                $this->id=$row["id"];
                $this->friendlyname=$row["friendlyname"];
                $this->physicalname=$row["physicalname"];
                $this->html=$row["HTML"];
                $this->pageid=$row["pageid"];
                $this->status_id_fk=$row["status_id_fk"];
                $st = new StatusModel( $this->status_id_fk);
                $this->status = $st->code;

            }
        }
    }
    
}