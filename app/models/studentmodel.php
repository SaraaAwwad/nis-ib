<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;


class StudentModel extends UserModel{

    public $concatenate = "@nis.edu.eg";

    public static function getAll(){

        $db = DatabaseHandler::getConnection();
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

    public static function insertInDB($stud){
        $db = DatabaseHandler::getConnection();

        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk, phone) 
        VALUES ('1', '$stud->fname','$stud->lname','$stud->gender', '$stud->DOB', '$stud->username', '$stud->password', '$stud->email', '$stud->status', '$stud->img','$stud->user_id_fk','$stud->address_id_fk','$stud->phone')";

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

    public static function getStudents($grade_id){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT user.id, user.fname, user.lname FROM
                user INNER JOIN student_level
                ON user.id = student_level.user_id_fk
                WHERE (scl_grade_id_fk = $grade_id )";
        $result = mysqli_query($db,$sql);
        $Res= false;
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
                $MyObj = new StudentModel($row["id"]);
                $MyObj->id = $row["id"];
                $MyObj->fname = $row["fname"];
                $MyObj->lname = $row["lname"];
                $Res[$i]=$MyObj;
                $i++;
        }
        return $Res;
    }


}