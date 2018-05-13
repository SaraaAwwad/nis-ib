<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class UserTypesModel extends AbstractModel{

    const ERR_EXIST = "err_user_exist";
    const ADD_SUCCESS = "add_user_type";

    const PUBLIC_TYPE = "public";

    public $id;
    public $title;
    public $status_id_fk;
    public $status;
    public $UserParentPages = array();
    public $pages = array();
    private $tableName = 'user_type';

    const PARENT = "parent";
    const STUDENT = "student";
    const ADMIN = "admin";
    const TEACHER = "teacher";


    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        
        $query = "SELECT * FROM ".$this->tableName ." Where id = '$this->id' ";
        $stmt =self::prepareStmt($query);        
       
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->title =  $row['title'];
              $this->status_id_fk = $row['status_id_fk'];
              $st= new StatusModel($this->status_id_fk);
              $this->status = $st->code;       
            }
        }

        $this->getUserParentPages();     
        $this->getAllPages();
     
    }

    public static function addUserType($title, $statusId){


        if(!self::isExist($title)){
            $query = "INSERT INTO
            user_type (title, status_id_fk)
            VALUES(:title, :status_id_fk)";

            $stmt = self::prepareStmt($query);  

            $title = self::test_input($title);  
            $statusId = self::test_input($statusId);  
            
            $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
            $stmt->bindParam(":status_id_fk", $statusId,  \PDO::PARAM_INT);

            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    
    public static function isExist($title){
        $query = "SELECT * from user_type where title = :title";

        $title = self::test_input($title);
        $stmt = self::prepareStmt($query);

        $stmt->bindParam(":title", $title);

        if($stmt->execute()){
           $numofrows =  $stmt->rowCount();
        }else {
            return false;
        }

        if($numofrows > 0){
            return true;
        }else {
            return false;
        }
    }

    Static function getAll(){
        $query = "SELECT * FROM user_type";
        $stmt = self::prepareStmt($query);        
        $Types= array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $UserTypeObj = new UserTypesModel($row['id']);
                $Types[$i] = $UserTypeObj;
                $i++;
            }
        return $Types;
        }else{
            return false;
        }

    }

    Static function getUserTypeExcept(){
        $query = "SELECT * FROM user_type WHERE title NOT IN ('student','parent')";
        $stmt = self::prepareStmt($query);
        $Types= array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $UserTypeObj = new UserTypesModel($row['id']);
                $Types[$i] = $UserTypeObj;
                $i++;
            }
            return $Types;
        }else{
            return false;
        }
    }

    public function update($title, $statusId){
        $sql = "UPDATE user_type SET title = :title, status_id_fk = :status_id_fk WHERE id = :id";
        
        $stmt = self::prepareStmt($sql);  
        
        $this->title = self::test_input($title);  
        $this->status_id_fk = self::test_input($statusId);

        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT); 
        $stmt->bindParam(':title', $this->title, \PDO::PARAM_STR);
        $stmt->bindParam(':status_id_fk', $this->status_id_fk,  \PDO::PARAM_INT);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getUserParentPages(){

        $query = "SELECT user_type_pages.pageid_fk from user_type_pages INNER JOIN pages ON pages.id = user_type_pages.pageid_fk 
        WHERE typeid_fk = '$this->id' AND pages.pageid = 0 order by ordervalue ";

        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            $i=0;
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->UserParentPages[$i] = new PagesModel($row['pageid_fk']);
                $i++;
            
            }
        }
    }

    public function getUserPages($parentid){
        $query = "SELECT user_type_pages.pageid_fk from user_type_pages INNER JOIN pages ON pages.id = user_type_pages.pageid_fk 
        WHERE typeid_fk = '$this->id' AND pages.pageid = '$parentid' order by ordervalue";
        
        $stmt = $this->prepareStmt($query);
        if($stmt->execute()){
            $i=0;
            $UserPages  = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $PageObj = new PagesModel($row['pageid_fk']);
                $UserPages[$i] = $PageObj;
                $i++;
            }

            return $UserPages;
        }
    }

    Static function getUsers(){
        $query = "SELECT * FROM user_type WHERE title NOT IN ('student','parent')";
        $stmt = self::prepareStmt($query);        
        $Types= array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $UserTypeObj = new UserTypesModel($row['id']);
                $Types[$i] = $UserTypeObj;
                $i++;
            }
        return $Types;
        }else{
            return false;
        }
    }

    public function getAllPages(){
        $query = "SELECT user_type_pages.pageid_fk from user_type_pages INNER JOIN pages ON pages.id = user_type_pages.pageid_fk 
        WHERE typeid_fk = '$this->id' ";
        
        $stmt = $this->prepareStmt($query);
        if($stmt->execute()){
            $i=0;
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->pages[$i] = new PagesModel($row['pageid_fk']);      
                $i++;
            }
        }
        
    }

    public function insertUserPages($pageid, $ordervalue){

        $query = "INSERT INTO user_type_pages (typeid_fk, pageid_fk, ordervalue)
        VALUES(:id, :pageid, :ordervalue)";

        $stmt = self::prepareStmt($query);  

        $pageid = self::test_input($pageid);  
        $ordervalue = self::test_input($ordervalue);  

        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);         
        $stmt->bindParam(":pageid", $pageid, \PDO::PARAM_INT);
        $stmt->bindParam(":ordervalue", $ordervalue,  \PDO::PARAM_INT);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function deleteAllPermissions(){
        $sql = "DELETE FROM user_type_pages WHERE typeid_fk = :id";
        $stmt = self::prepareStmt($sql); 
        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);         
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    Static function getUserTypeId(){
        $title = 'parent';
        $query = "SELECT id FROM user_type WHERE title = '$title'";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = $row['id'];
            }
        return $result;
        }else{
            return false;
        }
    }

    Static function getStudentTypeId(){
        $title = 'student';
        $query = "SELECT id FROM user_type WHERE title = '$title'";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = $row['id'];
            }
            return $result;
        }else{
            return false;
        }
    }

    Static function getTypeID($title){
        $query = "SELECT id FROM user_type WHERE title = '$title'";
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = $row['id'];
            }
            return $result;
        }else{
            return false;
        }
    }

    public static function count($usertitle){
        $query = "SELECT COUNT(user.id) from user inner join user_type ON user.type_id = user_type.id
         WHERE user_type.title = '$usertitle' ";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            $num_rows = $stmt->fetchColumn();
            return intval($num_rows);
        }else{
            return false;
        }
    }

    public static function countUserTypes(){
        $query = "SELECT COUNT(id) FROM user_type";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            $num_rows = $stmt->fetchColumn();
            return intval($num_rows);
        }else{
            return false;
        }
    }

    public static function getUserTypeByTitle($title){
        $query = "SELECT id FROM user_type WHERE title = '$title'";
        $stmt = self::prepareStmt($query);        
        $result = "";

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = $row['id'];
            }
        return $result;
        }else{
            return false;
        }
    }

}

