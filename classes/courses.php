<?php
	require_once("\..\db\database.php");

    class Courses {
        
        public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM course Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->course_code = $row['course_code'];
            $this->descr = $row['descr'];
            $this->level_id_fk = $row['level_id_fk'];
            $this->group_id_fk = $row['group_id_fk'];
            $this->status = $row['status'];
            $this->teaching_hours = $row['teaching_hours'];
        }
    }

    Static function InsertinDB($objCourse)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO course (name, course_code, descr, level_id_fk, group_id_fk, status, teaching_hours) VALUES ('$objCourse->cname', '$objCourse->ccode','$objCourse->descr','$objCourse->level', '$objCourse->group', '$objCourse->status', '$objCourse->hours')";
        $dbobj->executesql($sql);
    }

        Static function SelectAllCoursesInDB()
    {
        $dbobj = new dbconnect;
        $sql="SELECT course.*, scl_level.level, course_group.group_name, status.code FROM course INNER JOIN scl_level ON course.level_id_fk = scl_level.id INNER JOIN course_group ON course.group_id_fk = course_group.id INNER JOIN status ON course.status = status.id ORDER BY course.id";
        $result = $dbobj->executesql2($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Courses($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->name = $row["name"];
            $MyObj->course_code=$row["course_code"];
            $MyObj->descr=$row["descr"];
            $MyObj->level=$row["level"];
            $MyObj->group_name=$row["group_name"];
            $MyObj->active = $row["code"];
            $MyObj->teaching_hours = $row["teaching_hours"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
        }
    
      Static function SelectCourse($id)
    {
        $dbobj = new dbconnect;
        $sql="SELECT * from course Where id = $id";
        $result = $dbobj->executesql2($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Courses($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->name = $row["name"];
            $MyObj->course_code=$row["course_code"];
            $MyObj->descr=$row["descr"];
            $MyObj->teaching_hours = $row["teaching_hours"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
        }


    }
     
?>
