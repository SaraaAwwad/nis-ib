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
    public $phone;
    private $table_name = 'user';

    CONST ERR_LOGIN = "err_login_invalid";

    protected static $tableName = 'user';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'type_id'             => self::DATA_TYPE_INT,
        'fname'               => self::DATA_TYPE_STR,
        'lname'               => self::DATA_TYPE_STR,
        'gender'              => self::DATA_TYPE_STR,
        'DOB'                 => self::DATA_TYPE_DATE,
        'username'            => self::DATA_TYPE_STR,
        'pwd'                 => self::DATA_TYPE_STR,
        'email'               => self::DATA_TYPE_STR,
        'status'              => self::DATA_TYPE_INT,
        'img'                 => self::DATA_TYPE_STR,
        'user_id_fk'          => self::DATA_TYPE_INT,
        'add_id_fk'           => self::DATA_TYPE_INT,
        'phone'               => self::DATA_TYPE_INT

    );
    protected static $primaryKey = 'id';

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query = "SELECT * FROM ".$this->table_name ." Where id = '$this->id' ";
        $stmt =self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->type_id = $row['type_id'];
                $this->fname = $row['fname'];
                $this->lname = $row['lname'];
                $this->gender = $row['gender'];
                $this->DOB = $row['DOB'];
                $this->username = $row['username'];
                $this->pwd = $row['pwd'];
                $this->email = $row['email'];
                $this->status = $row['status'];
                $this->img = $row['img'];
                $this->user_id_fk = $row['user_id_fk'];
                $this->add_id_fk = $row['add_id_fk'];
                $this->phone = $row['phone'];

            }
        }
    }
    
    public static function getUsers(){
        return self::get(
        'SELECT user.*, user_type.title, salary.amount, status.code, telephone.number FROM ' . self::$tableName .
         ' INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN salary ON user.id = salary.user_id_fk
          INNER JOIN status ON user.status = status.id INNER JOIN telephone ON user.id = telephone.user_id_fk where title NOT IN ("student","parent")'
        );
    }

    Static function Login($username, $password){

        $result = self::isExist($username);

        $username = self::test_input($username);
        $password = self::test_input($password);

        if ($result){
            $row = $result->fetch(\PDO::FETCH_ASSOC);
             if(password_verify($password, $row['pwd'])){
                $_SESSION["userID"] = $row['id'];
                $_SESSION["userType"] = $row['type_id'];
                $_SESSION["userName"] = $row['fname'] .' - ' . $row['lname'];
                return true;
            }
        }
        return false;
    }


    Static function isExist($username){

        $sql = "SELECT * FROM user Where username = :username";

        $stmt = self::prepareStmt($sql); 
        $username = self::test_input($username);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        if($stmt->execute()){
            $numofrows =  $stmt->rowCount();
        }
        if($numofrows > 0 ) {
            return $stmt;
        }else{
            return false;

        }

    }

    static function getTeachers(){
        return self::get(
            'SELECT user.* FROM ' . self::$tableName .
             ' INNER JOIN user_type ON user.type_id = user_type.id 
               where user_type.title = "teacher" '
            );
    }

    public static function getUsersByUserType($type_id){
        return self::getArr(
            'SELECT user.* FROM ' . self::$tableName .
            ' WHERE type_id = '.$type_id.' '
        );
    }

    public static function getStudents($exam_id){
        return self::getArr(
            'select user.id, user.fname, user.lname, user.phone, user.email
            From ' . self::$tableName . ' inner JOIN exam_registration on exam_registration.user_id_fk = user.id
            INNER JOIN exam_details ON exam_details.id = exam_registration.exam_id_fk
            WHERE exam_details.id = '.$exam_id.'
            GROUP BY user.id');
    }


    public function cryptPassword($password)
    {
        $this->pwd =  password_hash($password, PASSWORD_BCRYPT, array('cost'=>8));
    }

    public static function UsernameExist($username){
        $query = "SELECT * from user where username = :username";
        $username = self::test_input($username);

        $stmt = self::prepareStmt($query);
        $stmt->bindParam(":username", $username);
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
}
