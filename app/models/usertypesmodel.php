<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class UserTypesModel extends AbstractModel {
    public $id;
    public $title;
    public $status_id_fk;
    public $status;
    public $UserParentPages = array();
    public $pages = array();

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $sql = "SELECT * FROM user_type Where id = '$id' ";
        $db = DatabaseHandler::getConnection();
        $userinfo = mysqli_query($db,$sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->status_id_fk = $row['status_id_fk'];
            $st = new StatusModel( $this->status_id_fk);
            $this->status = $st->code;
            }   
        $this->getUserParentPages();
        $this->getAllPages();
    }

    public static function addUserType($title, $statusId){
        $db = DatabaseHandler::getConnection();
        $sql = "INSERT INTO user_type (title, status_id_fk) 
        VALUES ('$title', '$statusId')";
        if (mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
        }
    }
    
    Static function getAll(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM user_type";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $UserTypeObj = new UserTypesModel($row['id']);
            $Types[$i] = $UserTypeObj;
            $i++;
        }
        return $Types;
    }


    public function update($title, $statusId){
        $this->title = $title;
        $this->status_id_fk = $statusId;

        $db = DatabaseHandler::getConnection();
        $sql = "UPDATE user_type SET title= '$this->title' , status_id_fk= '$this->status_id_fk' WHERE id='$this->id'";
                
                if (mysqli_query($db, $sql)){
                    return true;
                }else{
                   return false;
               // die(mysqli_error($db));
                }
    }

    public function getUserParentPages(){

        $sql = "SELECT user_type_pages.pageid_fk from user_type_pages INNER JOIN pages ON pages.id = user_type_pages.pageid_fk 
        WHERE typeid_fk = '$this->id' AND pages.pageid = 0 order by ordervalue ";
        
        $db = DatabaseHandler::getConnection();
        $result = mysqli_query($db,$sql);
        $i=0;
        if($result){
            while ($row = mysqli_fetch_assoc($result)){
                $this->UserParentPages[$i] = new PagesModel($row['pageid_fk']);
                $i++;
            }
        }
    }

    public function getUserPages($parentid){
        $sql = "SELECT user_type_pages.pageid_fk from user_type_pages INNER JOIN pages ON pages.id = user_type_pages.pageid_fk 
        WHERE typeid_fk = '$this->id' AND pages.pageid = '$parentid' order by ordervalue";

        $db = DatabaseHandler::getConnection();
        $result = mysqli_query($db,$sql);
        $i=0;
        $UserPages  = array();
        while ($row = mysqli_fetch_assoc($result)){
            $PageObj = new PagesModel($row['pageid_fk']);
            $UserPages[$i] = $PageObj;
            $i++;
        }

        return $UserPages;
    }


    Static function getUsers(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM user_type WHERE title NOT IN ('student','Student')";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $UserTypeObj = new UserTypesModel($row['id']);
            $Types[$i] = $UserTypeObj;
            $i++;
        }
        return $Types;
    }


    public function getAllPages(){
        $sql = "SELECT user_type_pages.pageid_fk from user_type_pages INNER JOIN pages ON pages.id = user_type_pages.pageid_fk 
        WHERE typeid_fk = '$this->id'
        order by ordervalue";

        $db = DatabaseHandler::getConnection();
        $result = mysqli_query($db,$sql);
        $i=0;
        
        if($result){
            while ($row = mysqli_fetch_assoc($result)){
                $this->pages[$i] = new PagesModel($row['pageid_fk']);      
                $i++;
            }
        }
    }

   
    public function insertUserPages($pageid, $ordervalue){
        $sql = "INSERT INTO user_type_pages (typeid_fk, pageid_fk, ordervalue) VALUES ('$this->id', '$pageid', '$ordervalue')";
        $db = DatabaseHandler::getConnection();
        $result = mysqli_query($db,$sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function deleteAllPermissions(){
        $sql = "DELETE FROM user_type_pages WHERE typeid_fk ='$this->id'";
        $db = DatabaseHandler::getConnection();
        $result = mysqli_query($db,$sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    /*
    Static function getUserTypeId(){
        $dbobj= new dbconnect;
        $title = 'parent';
        $sql = "SELECT id FROM user_type WHERE title = '$title'";
        $qresult = $dbobj->selectsql($sql);
        while($row = mysqli_fetch_array($qresult)){
            $result = $row['id'];
        }
        return $result;
    }

    Static function getStudentId(){
        $dbobj= new dbconnect;
        $title = 'student';
        $sql = "SELECT id FROM user_type WHERE title = '$title'";
        $qresult = $dbobj->selectsql($sql);
        while($row = mysqli_fetch_array($qresult)){
            $result = $row['id'];
        }
        return $result;
    }

    Static function getUser($title){
        $dbobj= new dbconnect;
        $sql = "SELECT id FROM user_type WHERE title = '$title'";
        $qresult = $dbobj->selectsql($sql);
        while($row = mysqli_fetch_array($qresult)){
            $result = $row['id'];
        }
        return $result;
    }*/

}

