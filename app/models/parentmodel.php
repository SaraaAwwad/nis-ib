<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ParentModel extends UserModel{

    public $concatenate = "@nis.edu.eg";

    public static function getByUsername($pk){
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE username = "' . $pk . '"';
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

    Static function InsertinDB($objParent)
    {
        
        $result = UserTypesModel::getUserTypeId();
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk)
                VALUES ('$result', '$objParent->fname','$objParent->lname','$objParent->gender', '$objParent->DOB',
                 '$objParent->username', '$objParent->pwd', '$objParent->email', '$objParent->status',
                  '$objParent->img','$objParent->user_id_fk','$objParent->add_id_fk')";
        $db = DatabaseHandler::getConnection();
        $idresult = mysqli_query($db,$sql);
        return $idresult;
    }

    Static function getExistingParent($username)
    {
       
        $sql = "SELECT id FROM user Where username = '$username'";
        $db = DatabaseHandler::getConnection();
        $idresult = mysqli_query($db,$sql);
        while($row = mysqli_fetch_array($idresult)){
                $result = $row['id'];
            }
            return $result;
    }

    static public function getChildren(){

        $query = "SELECT id , fname, lname FROM ".static::$tableName." WHERE user_id_fk = ". $_SESSION['userID'];
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

    static public function getParent(){

        $query = "SELECT id , fname, lname FROM ".static::$tableName." WHERE user_id_fk = ". $_SESSION['userID'];
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

}

?>