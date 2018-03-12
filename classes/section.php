<?php
	require_once("\..\db\database.php");

    class Section {
        
        public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM section Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->course_id_fk = $row['course_id_fk'];
            $this->teacher_id_fk = $row['teacher_id_fk'];
            $this->semester_id_fk = $row['semester_id_fk'];
            $this->code = $row['code'];
        }
    }

    Static function InsertinDB($objCourse)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO course (name, course_code, descr, level_id_fk, group_id_fk, status, teaching_hours) VALUES ('$objCourse->cname', '$objCourse->ccode','$objCourse->descr','$objCourse->level', '$objCourse->group', '$objCourse->status', '$objCourse->hours')";
        $dbobj->executesql($sql);
    }

        Static function SelectAllSectionsInDB()
        {
        $dbobj = new dbconnect;
        $sql="SELECT section.*, course.name, user.username, semester.year FROM section INNER JOIN course ON course.id = section.course_id_fk INNER JOIN user ON user.id = section.teacher_id_fk INNER JOIN semester ON semester.id = section.semester_id_fk ORDER BY section.id";

        $result = $dbobj->executesql2($sql);
        $i=0;
        $Result = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $MyObj= new Section($row["id"]);
            $MyObj->id=$row["id"];
            $MyObj->name = $row["name"];
            $MyObj->username=$row["username"];
            $MyObj->year=$row["year"];
            $MyObj->code=$row["code"];
            $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;
        }

    }
     
?>
