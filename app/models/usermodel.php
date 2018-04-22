<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class UserModel extends AbstractModel {

    public $id;
    public $type_id;
    public $fname;
    public $lname;
    public $gender;
    public $DOB;
    public $username;
    public $pwd;
    public $email;
    public $status;
    public $img;
    public $user_id_fk;
    public $add_id_fk;

    protected static $tableName = 'user';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'type_id'             => self::DATA_TYPE_INT,
        'fname'               => self::DATA_TYPE_STR,
        'lname'               => self::DATA_TYPE_STR,
        'gender'              => self::DATA_TYPE_STR,
        'DBO'                 => self::DATA_TYPE_DATE,
        'username'            => self::DATA_TYPE_STR,
        'pwd'                 => self::DATA_TYPE_STR,
        'email'               => self::DATA_TYPE_STR,
        'status'              => self::DATA_TYPE_INT,
        'img'                 => self::DATA_TYPE_STR,
        'user_id_fk'          => self::DATA_TYPE_INT,
        'add_id_fk'           => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

    public static function getUsers(){
        return self::get(
        'SELECT user.*, user_type.title, salary.amount, status.code, telephone.number FROM ' . self::$tableName .
         ' INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN salary ON user.id = salary.user_id_fk
          INNER JOIN status ON user.status = status.id INNER JOIN telephone ON user.id = telephone.user_id_fk where title NOT IN ("student","parent")'
        );
    }

    
    Static function Login($username, $password){
        $result = self::isExist($username);

        if ($result){
            $row = mysqli_fetch_array($result);
            //if(password_verify($pw, $row['pwd'])){
            if($password== $row['pwd']){
                session_start();
                $_SESSION["userID"] = $row['id'];
                $_SESSION["userType"] = $row['type_id'];
                return true;
            }
        }
        return false;
    }

        
	Static function isExist($username){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM user Where username = '$username' ";
        $qresult = $db->query($sql);
        if($qresult->num_rows > 0 ) {
            return $qresult;
        }else{
            return false;
        }
    }
    public static function getByPK($id){
        $db = DatabaseHandler::getConnection();
        $sql ="SELECT * FROM `user` WHERE id = '$id'"; //and status == active
        $result = mysqli_query($db,$sql);
        $Res= false;
        $i=0;
        while ($row = mysqli_fetch_assoc($result))
        {
            //$MyObj= new StudentModel($row["id"]);
            $Res['id']=$row["id"];
            $Res['fname']=$row["fname"];
            $Res['lname']=$row["lname"];
            $Res['gender']=$row["gender"];
            $Res['DOB']=$row["DOB"];
            $Res['username']=$row["username"];
            $Res['email']=$row["email"];
            $Res['img']=$row["img"];
            $Res['password']=$row["pwd"];
            $Res['phone']=$row["phone"];
            $Res['address_id_fk'] = $row["add_id_fk"];
            $Res['status'] = $row["status"];
            //$Res=$MyObj;
        }
        return $Res;
    }

    static function getTeachers(){
        //add: where they are available at the given day and slot
        return self::get(
            'SELECT user.* FROM ' . self::$tableName .
             ' INNER JOIN user_type ON user.type_id = user_type.id 
               where user_type.title = "teacher" '
            );

    }
}
