<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ParentModel{

    public $concatenate = "@nis.edu.eg";

    public function __construct($id=""){
		if($id != ""){
            parent::__construct($id);
        }
    }

    public function sendMessage($subject, $body, $to, $isReply){
        //send msg to user
        
    }

    Static function InsertinDB($objParent)
    {
        
        $result = UserType::getUserTypeId();
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk) VALUES ('$result', '$objParent->fname','$objParent->lname','$objParent->gender', '$objParent->DOB', '$objParent->username', '$objParent->pwd', '$objParent->email', '$objParent->status', '$objParent->img','$objParent->parent','$objParent->address_id_fk')";
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


    
}

?>