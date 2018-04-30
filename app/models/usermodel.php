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

        if ($result){
            if($password== $result['pwd']){
                session_start();
                $_SESSION["userID"] = $result['id'];
                $_SESSION["userType"] = $result['type_id'];
                return true;
            }
        }
        return false;
    }

    Static function isExist($username){

        $query = "SELECT * FROM user Where username = '$username' ";
        $stmt =self::prepareStmt($query);
        if($stmt->execute()){

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $num_rows = count($result);
            if($num_rows > 0 ) {

                return $result;
            }else{
                return false;
            }

        }

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
