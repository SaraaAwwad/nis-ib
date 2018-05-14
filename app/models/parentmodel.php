<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ParentModel extends UserModel{

    public $concatenate = "@nis.edu.eg";

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public static function getByUsername($pk){

        $sql = 'SELECT * FROM user WHERE username = "' . $pk . '"';
        $stmt = self::prepareStmt($sql);
        if($stmt->execute()){

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $MyObj = new ParentModel($row["id"]);
            }
            return $MyObj;
        }
    }

    public function add()
    {
        $result = UserTypesModel::getUserTypeId(); //parent?
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk)
                VALUES ('$result', :fname ,:lname,:gender, :DOB,:username, :pwd, :email, :status,
                  :img,:user_id_fk,:add_id_fk)";

        $stmt = self::prepareStmt($sql);
        $stmt->bindParam(':fname', $this->fname);
        $stmt->bindParam(':lname', $this->lname);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':DOB', $this->DOB);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':pwd', $this->pwd);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':user_id_fk', $this->user_id_fk);
        $stmt->bindParam(':add_id_fk', $this->add_id_fk);

        if ($stmt->execute()){
            $this->id = self::getLastId(); 
            return true;
        }else{
            return false;
        }

    }

    Static function getExistingParent($username)
    {
        $sql = "SELECT id FROM user WHERE username = '$username'";
        $stmt = self::prepareStmt($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result = new ParentModel($row['id']);
            } }
            return $result;
    }

    static public function getChildren(){

        $query = "SELECT id , fname, lname FROM ".static::$tableName." WHERE user_id_fk = ". $_SESSION['userID'];
        $stmt = self::prepareStmt($query);
        $children = array();
        $i=0;
        if($stmt->execute()){

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $childrenobj = new StudentModel($row['id']);
                $childrenobj->getGrade();
                $children[$i] = $childrenobj;
                $i++;
            }
            return $children;
        }else{
            return false;
        }

    }


    static public function getParent($parent_id = " "){

        if($parent_id = " ")
        {
            $parent_id =  $_SESSION['userID'];
        }
        $query = "SELECT id , fname, lname FROM ".static::$tableName." WHERE user_id_fk = ".$parent_id;
        $stmt = self::prepareStmt($query);
        $children = array();
        $i=0;
        if($stmt->execute()){

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                //echo $row['id'];
                $childrenobj = new StudentModel($row['id']);
                $childrenobj->getGrade();
                $children[$i] = $childrenobj;
                $i++;
            }
            return $children;
        }else{
            return false;
        }

    }

    static public function getParentOf($child_id){

        $query= "SELECT user_id_fk FROM ". self::$tableName ." WHERE id = " . $child_id;
        $stmt = self::prepareStmt($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $parentObj = new ParentModel($row['user_id_fk']);
            }
            return $parentObj;
        }else{
            return false;
        }
    }

    public function cryptPassword($password)
    {
        $this->pwd =  password_hash($password, PASSWORD_BCRYPT, array('cost'=>8));
    }



}

?>