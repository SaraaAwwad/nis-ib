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

    Static function InsertinDB($objSection)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO section (course_id_fk, teacher_id_fk, semester_id_fk, code) VALUES ('$objSection->courseid', '$objSection->username','$objSection->semester','$objSection->sectioncode')";
        $id = $dbobj->insertsql($sql);
        $sql1 = "INSERT INTO schedule (section_id, room_id, day_id_fk, slot_id_fk) VALUES ('$id', '$objSection->room','$objSection->day','$objSection->slot')";
        $dbobj->executesql($sql1);
        return $id;
    }

        Static function SelectAllSectionsInDB($id)
        {
        $dbobj = new dbconnect;
        $sql="SELECT section.*, course.name, user.username, semester.year FROM section INNER JOIN course ON course.id = section.course_id_fk INNER JOIN user ON user.id = section.teacher_id_fk INNER JOIN semester ON semester.id = section.semester_id_fk Where section.course_id_fk = '$id' ORDER BY section.id";

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
