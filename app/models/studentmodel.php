<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;


class StudentModel {
    public $id;
    public $username;
    public $fname;
    public $lname;
    public $DOB;
    public $email;
    public $gender;
    public $img;
    //public $OtherPhones;
    public $phone;
    public $address_id_fk;
    public $status;
    public $password;
    public $user_id_fk;
    //const tableName = 'user';
    //public $dbfields = array('type_id', 'fname', 'lname', 'gender', 'DOB', 'username',
    //                        'pwd', 'email', 'status', 'img', 'user_id_fk', 'add_id_fk');

    public function __construct($id=""){

		if($id != ""){
            $this->id = $id;
        }
    }

    public static function getAll(){

        $db = DatabaseHandler::getConnection();
       //$sql ="SELECT * FROM " . StudentModel::tableName;
        $sql ="SELECT * FROM user ";
        $result = mysqli_query($db,$sql);
        $Res = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new StudentModel($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->fname=$row["fname"];
            $MyObj->lname=$row["lname"];
            $MyObj->gender=$row["gender"];
            $MyObj->DOB=$row["DOB"];
            $MyObj->password=$row["pwd"];  
            $MyObj->username=$row["username"];
            $MyObj->email=$row["email"];
            $MyObj->phone=$row["phone"];
            $MyObj->status=$row["status"];  
            $Res[$i]=$MyObj;
            $i++;
        }

        return $Res;
    }

    public static function insertInDB($objUser){
        $db = DatabaseHandler::getConnection();

        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk) 
        VALUES ('1', '$objUser->fname','$objUser->lname','$objUser->gender', '$objUser->DOB', '$objUser->username', '$objUser->pwd', 
        '$objUser->email', '$objUser->status', '$objUser->img','$objUser->user_id_fk','$objUser->address_id_fk')";

        if (mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
        // die(mysqli_error($db));
        }
    }

    public static function getByPK($id){
        $db = DatabaseHandler::getConnection();

        $sql ="SELECT * FROM `user` WHERE id = '$id'";
        $result = mysqli_query($db,$sql);
        $Res= false;
        $i=0;
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new StudentModel($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->fname=$row["fname"];
            $MyObj->lname=$row["lname"];
            $MyObj->gender=$row["gender"];
            $MyObj->DOB=$row["DOB"];
            $MyObj->username=$row["username"];
            $MyObj->email=$row["email"];
            $MyObj->img=$row["img"];
            $MyObj->password=$row["pwd"];
            $MyObj->phone=$row["phone"];
            $MyObj->address_id_fk = $row["add_id_fk"];
            $MyObj->status = $row["status"];
            $Res=$MyObj;
        }

        return $Res;
    }

    public function update(){
        $db = DatabaseHandler::getConnection();
        $sql = "UPDATE user SET fname= '$this->fname' ,lname='$this->lname', DOB='$this->DOB', phone = '$this->phone',
         gender='$this->gender', email='$this->email'
        , pwd = '$this->password', username = '$this->username', img = '$this->img' WHERE id='$this->id'";
                
                if (mysqli_query($db, $sql)){
                    return true;
                }else{
                   return false;
                 //die(mysqli_error($db));
                }
    }

    public function getLevel(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT level FROM scl_level";
        $result = mysqli_query($db,$sql);
        $Res = array();
        while ($row = mysqli_fetch_assoc($result)){
            $Res[] = $row;
        }
        return $Res;

    }

}