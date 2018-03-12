<?php
	require_once("\..\db\database.php");

    class Semester {
        
        public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $dbobj = new dbconnect;
        $sql = "SELECT * FROM semester Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->season_id_fk = $row['season_id_fk'];
            $this->year = $row['year'];
            $this->start_date = $row['start_date'];
            $this->end_date = $row['end_date'];
        }
    }

    Static function InsertinDB($objCourse)
    {
        $dbobj = new dbconnect;
        $sql = "INSERT INTO course (name, course_code, descr, level_id_fk, group_id_fk, status, teaching_hours) VALUES ('$objCourse->cname', '$objCourse->ccode','$objCourse->descr','$objCourse->level', '$objCourse->group', '$objCourse->status', '$objCourse->hours')";
        $dbobj->executesql($sql);
    }

       Static function getAllSemester(){
            $dbobj= new dbconnect;
            $sql = "SELECT semester.*, season.season_name FROM semester inner join season on semester.season_id_fk = season.id";
            $result = $dbobj->selectsql($sql);
            $Groups= array();
            $i=0;
            while ($row = mysqli_fetch_assoc($result)){
                $MyObj= new Semester($row["id"]);
                $MyObj->id = $row['id'];
                $MyObj->year = $row['year'];
                $MyObj->season_name = $row['season_name'];
                $Groups[$i] = $MyObj;
                $i++;
            }
            return $Groups;
        }

    }
     
?>
