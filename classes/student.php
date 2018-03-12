<?php
	require_once("..\db\database.php");
    require_once("user.php");
    require_once("usertype.php");

class Student extends User{
    private $GPA;
    public $level;
    public $sclgrade;

    //aggregation

    public function __construct($id=""){
		if($id != ""){
            parent::__construct($id);
            //$this->getInfo2($id);
           // $this->registeration = new Registeration();
        }
    }

    public function getStudentInfo($id){
        //get rest info of the student 
        //sql to get the level: pyp-myp-dp
        //to get which year scl grade
    }


    public function addCourseWork($id, $submission){
        //add in table coursework 
    }

    public function getRegisteredCourses($semesterid){
        //select all the courses
    }

    public function viewFees($registerationObj){
        //return fees
    }

    public function viewTranscript($transcript){
        //select from transcript where transcript id = "" and semester id = "" ;
    }

    public function viewCourseWork($CourseWork){
        //coursework = new CourseWork();
        //select from cw 
    }

    
    Static function InsertinDB($objUser)
    {
        $dbobj = new dbconnect;
        $result = UserType::getStudentId();
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk) VALUES ('$result', '$objUser->fname','$objUser->lname','$objUser->gender', '$objUser->DOB', '$objUser->username', '$objUser->pwd', '$objUser->email', '$objUser->status', '$objUser->img','$objUser->user_id_fk','$objUser->address_id_fk')";
        $idresult = $dbobj->insertsql($sql);
        return $idresult;
    }

    Static function SelectAllInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT user.*, user_type.title, status.code, telephone.number FROM user INNER JOIN user_type ON user.type_id = user_type.id INNER JOIN status ON user.status = status.id INNER JOIN telephone ON user.id = telephone.user_id_fk where title = 'student'";
        $result = $dbobj->executesql2($sql);
        $i=0;
        $data = array();
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Student($row["id"]);
            $MyObj->id=$row["id"];
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

    Static function getRegisteredStudents()
    {
        $dbobj = new dbconnect;
        $sql="SELECT user.*, registration.* from registration inner join user on user.id = registration.student_id where registration.id NOT IN (Select reg_id_fk From registration_details);";
        $result = $dbobj->executesql2($sql);
        $i=0;
        $data = array();
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Student($row["id"]);
            $MyObj->id=$row["id"];
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

    

}
    
?>