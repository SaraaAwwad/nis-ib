<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

abstract class UserModel {

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

}