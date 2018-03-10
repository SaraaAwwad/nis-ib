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
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img) VALUES ('$objUser->type_id', '$objUser->fname','$objUser->lname','$objUser->gender', '$objUser->DOB', '$objUser->username', '$objUser->pwd', '$objUser->email', '$objUser->status', '$objUser->img')";
        $result = $dbobj->insertsql($sql);
        $sql1 = "INSERT INTO user_address (user_id_fk, address_id_fk)
        VALUES('$result','$objUser->address_id_fk')";
        $dbobj->selectsql($sql1);
        $sql2 = "INSERT INTO salary (user_id_fk, amount, currency_id)
        VALUES('$result','$objUser->amount','$objUser->currency')";
        $dbobj->executesql($sql2);
    }

    Static function SelectAllStaffInDB()
    {
        $dbobj = new dbconnect;
        $salary = new Salary;
        $usertype = new UserType;
        $sql="SELECT user.*, user_type.title, salary.amount, status.code FROM user INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN salary ON user.id = salary.user_id_fk INNER JOIN status ON user.status = status.id where title NOT IN ('student','parent')";
        $result = $dbobj->selectsql($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Teacher($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->salary = $row["amount"];
            $MyObj->fname=$row["fname"];
            $MyObj->lname=$row["lname"];
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

}
    
?>