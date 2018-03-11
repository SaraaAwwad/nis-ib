<?php
    require_once("..\db\database.php");
    require_once("user.php");
    require_once("salary.php");
    require_once("Registeration.php");
class Teacher extends User{
    //aggregation
    public function __construct($id=""){
        if($id != ""){
            parent::__construct($id);
        }
    }
    Static function InsertinDB($objUser)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk) VALUES ('$objUser->type_id', '$objUser->fname','$objUser->lname','$objUser->gender', '$objUser->DOB', '$objUser->username', '$objUser->pwd', '$objUser->email', '$objUser->status', '$objUser->img','0','$objUser->address_id_fk')";
        $result = $dbobj->insertsql($sql);
        $sql2 = "INSERT INTO salary (user_id_fk, amount, currency_id)
        VALUES('$result','$objUser->amount','$objUser->currency')";
        $dbobj->executesql($sql2);
    }

    Static function SelectAllStaffInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT user.*, user_type.title, salary.amount, status.code, telephone.number FROM user INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN salary ON user.id = salary.user_id_fk INNER JOIN status ON user.status = status.id INNER JOIN telephone ON user.id = telephone.user_id_fk where title NOT IN ('student','parent')";
        $result = $dbobj->executesql2($sql);
        $i=0;
        $data = array();
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Teacher($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->salary = $row["amount"];
            $MyObj->fname=$row["fname"];
            $MyObj->lname=$row["lname"];
            $MyObj->telephone=$row["number"];
            $MyObj->gender=$row["gender"];
            $MyObj->DOB=$row["DOB"];
            $MyObj->username=$row["username"];
            $MyObj->pwd=$row["pwd"];
            $MyObj->email=$row["email"];
            $MyObj->active = $row["code"];
            $MyObj->usertype = $row["title"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
    }
    
    public function changeActive($status){
        $sql = "UPDATE user SET status = '$status' WHERE id='$this->id'";
        $this->dbobj->executesql2($sql);
    }


}
?>