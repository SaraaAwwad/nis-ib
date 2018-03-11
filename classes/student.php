<?php
	require_once("\..\db\database.php");
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

    

}
    
?>