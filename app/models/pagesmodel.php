<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class PagesModel extends AbstractModel{

    public $id;
	public $friendlyname;
	public $physicalname;
	public $html;
	public $pageid;
    public $status_id_fk;
    public $status;
    public $parent;
    public $publisher;
    private $tableName = "pages";
    public function __construct($id=""){
		if($id != ""){
            $this->id = $id;
			$this->getInfo();
		}
    }

    public static function getAll(){ 
        $query = "SELECT * FROM pages";
        $stmt = self::prepareStmt($query);        
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $MyObj= new PagesModel($row['id']);
                $Res[$i]=$MyObj;
                $i++;
            }
        return $Res;
        }else{
            return false;
        }
    }

    public static function insertPage($friendlyname, $physicalname, $status_id, $parentid, $html){

        $sql = "INSERT INTO pages (friendlyname, physicalname, status_id_fk, pageid, HTML, layout_id_fk) 
        VALUES (:friendlyname, :physicalname, :status_id, :parentid, :html, 1)";

        $stmt = self::prepareStmt($sql);  

        $friendlyname = self::test_input($friendlyname);  
        $physicalname = self::test_input($physicalname);  
        $html = self::test_input($html);  
        
        $stmt->bindParam(':friendlyname', $friendlyname, \PDO::PARAM_STR);         
        $stmt->bindParam(":physicalname", $physicalname, \PDO::PARAM_STR);
        $stmt->bindParam(":status_id", $status_id,  \PDO::PARAM_INT);
        $stmt->bindParam(":parentid", $parentid,  \PDO::PARAM_INT);
        $stmt->bindParam(":html", $html,  \PDO::PARAM_STR);

        if ($stmt->execute()){
            return true;
        }else{
            exit();
            return false;
        }
    }

    public static function getAllParentPages(){
        
    }

    public function getInfo(){
        $query = "SELECT * FROM ".$this->tableName ." Where id = '$this->id' ";
        $stmt = $this->prepareStmt($query);

          if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){

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
    
    public function getAllPermissions(){
        $sql = "SELECT user_type.*FROM user_type_pages INNER JOIN user_type ON user_type.id = user_type_pages.typeid_fk WHERE pageid_fk = '$this->id' ";
<<<<<<< HEAD
        $result = mysqli_query($db,$sql);
=======
        $stmt = self::prepareStmt($sql);  

>>>>>>> af3ac641884192f98d8a48b7a328dcbd86f7bba3
        $Res = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){  
                $userTypesObj = new UserTypesModel($row['id']);
                $Res[$i]=$userTypesObj;
                $i++;
            }
        }
        return $Res;
    }
}