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

        $sql = "INSERT INTO pages (friendlyname, physicalname, status_id_fk, pageid, HTML) 
                VALUES (:friendlyname, :physicalname, :status_id, :parentid, :html)";

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
            return false;
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM pages Where id = '$this->id' ";
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
        $sql = "SELECT user_type.*FROM user_type_pages INNER JOIN user_type
                ON user_type.id = user_type_pages.typeid_fk WHERE pageid_fk = '$this->id' ";
        $stmt = self::prepareStmt($sql);
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

    public function getPublicPage($id){
        $query = "SELECT pages.* from pages inner join user_type_pages on user_type_pages.pageid_fk = pages.id 
        where pages.id =:id AND user_type_pages.typeid_fk =:public";

        $stmt = self::prepareStmt($query);
        
        $id = self::test_input($id);

        $pub = UserTypesModel::PUBLIC_TYPE;
        $pub = UserTypesModel::getUserTypeByTitle($pub);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":public", $pub);
        
        if($stmt->execute()){
            $row =  $stmt->fetch(\PDO::FETCH_ASSOC);
            $pageObj = new PagesModel($row["id"]);
            return $pageObj;
        }else{
            return false;
        }
    }

    public static function getPage($id){
        $query = "SELECT pages.* from pages inner join user_type_pages on user_type_pages.pageid_fk = pages.id 
        where pages.id =:id AND user_type_pages.typeid_fk =:type";

        $stmt = self::prepareStmt($query);
        
        $id = self::test_input($id);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":type", $_SESSION["userType"]);
        
        if($stmt->execute()){
            $row =  $stmt->fetch(\PDO::FETCH_ASSOC);
            $pageObj = new PagesModel($row["id"]);
            return $pageObj;
        }else{
            return false;
        }
    }

    public function getPageByTitle($title){
        $query = "SELECT pages.* from pages inner join user_type_pages on user_type_pages.pageid_fk = pages.id 
        where pages.physicalname =:title AND user_type_pages.typeid_fk =:type";

        $stmt = self::prepareStmt($query);
        
        $title = self::test_input($title);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":type", $_SESSION["userType"]);
        
        if($stmt->execute()){
            $row =  $stmt->fetch(\PDO::FETCH_ASSOC);
            if($row["id"]!=""){
                $pageObj = new PagesModel($row["id"]);
                return $pageObj;
            }
        }
            return false;
    }

    public function isExist(){
        $query = "SELECT pages.* from pages where id=:id";
    }
}