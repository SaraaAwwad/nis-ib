<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class UserModel extends AbstractModel {

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

} 