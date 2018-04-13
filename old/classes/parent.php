<?php
	require_once("..\db\database.php");
    require_once("user.php");
    require_once("usertype.php");

class Parents extends User{
    
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
        $dbobj = new dbconnect;
        $result = UserType::getUserTypeId();
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk) VALUES ('$result', '$objParent->fname','$objParent->lname','$objParent->gender', '$objParent->DOB', '$objParent->username', '$objParent->pwd', '$objParent->email', '$objParent->status', '$objParent->img','$objParent->parent','$objParent->address_id_fk')";
        $idresult = $dbobj->insertsql($sql);
        return $idresult;
    }

    Static function getExistingParent($username)
    {
        $dbobj = new dbconnect;
        $sql = "SELECT id FROM user Where username = '$username'";
        $idresult = $dbobj->executesql2($sql);
        while($row = mysqli_fetch_array($idresult)){
                $result = $row['id'];
            }
            return $result;
    }


    
}

?>