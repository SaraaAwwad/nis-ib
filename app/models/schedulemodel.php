<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class ScheduleModel extends AbstractModel {

    public $id;
    public $semester_id_fk;
    public $class_id_fk ;
    public $status_id_fk;
    public $sched_details ;
    public $class_name;
    public $year;
    public $season_name;
    public $code; 

    public function add(){
        
        $sql = "INSERT INTO schedule (semester_id_fk, class_id_fk, status_id_fk) 
                VALUES (:semester_id_fk, :class_id_fk, :status_id_fk)";

        $stmt = self::prepareStmt($sql);  

        
        $stmt->bindParam(':semester_id_fk', $this->semester_id_fk);         
        $stmt->bindParam(":class_id_fk", $this->class_id_fk);
        $stmt->bindParam(":status_id_fk", $this->status_id_fk);

        if ($stmt->execute()){
            return true;
        }else{
        //    exit();
            return false;
        }

    }

    public function edit(){
        $sql = "UPDATE schedule SET semester_id_fk = :semester_id_fk, status_id_fk = :status_id_fk, 
        class_id_fk = :class_id_fk WHERE id = :id";
        
        $stmt = self::prepareStmt($sql);  

        $stmt->bindParam(':id', $this->id); 
        $stmt->bindParam(':semester_id_fk', $this->semester_id_fk);
        $stmt->bindParam(':class_id_fk', $this->class_id_fk);        
        $stmt->bindParam(':status_id_fk', $this->status_id_fk);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function isExist(){
        $query = 'SELECT * FROM schedule
        WHERE class_id_fk = '.$this->class_id_fk.' AND 
        semester_id_fk = '.$this->semester_id_fk .' ';

      $stmt = $this->prepareStmt($query);  
        $sched = "";
        if($stmt->execute()){
          while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $sched = new ScheduleModel($row['id']);  
          }
        }

        if ($sched!=""){
            return true;
        }
     return false;
    }

    public function getFreeDays($slot){ 
        $query = 'SELECT weekdays.* FROM weekdays
        WHERE  weekdays.id NOT IN (SELECT day_id_fk
        FROM  schedule_details
        WHERE sched_id_fk = '.$this->id.'
        AND slot_id_fk = '.$slot.')';

        
        $stmt = $this->prepareStmt($query);  
        $weekdays = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
               $w = new WeekdaysModel($row['id']);
               $weekdays[$i] = $w;
               $i++;
            }
        }
        return $weekdays;
    }

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
    }

    public function getInfo(){
        $query = 'SELECT schedule.*, class.name, class.grade_id_fk, semester.year, season.season_name, status.code  FROM schedule INNER JOIN
          class ON schedule.class_id_fk = class.id
         INNER JOIN status ON schedule.status_id_fk = status.id
         INNER JOIN semester ON schedule.semester_id_fk = semester.id
         INNER JOIN season ON semester.season_id_fk = season.id 
         Where schedule.id = '.$this->id.'';

        $stmt = $this->prepareStmt($query);  

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->semester_id_fk = $row['semester_id_fk'];
            $this->class_id_fk = $row['class_id_fk'];
            $this->status_id_fk = $row['status_id_fk'];
            $this->class_name = $row['name'];
            $this->year = $row['year'];
            $this->season_name = $row['season_name'];
            $this->code = $row['code'];
            $this->grade_id_fk = $row['grade_id_fk'];
        }
       $this->sched_details = ScheduleDetailsModel::getDet($this->id);
    }

    public static function getAllStudentSched(){

        $query = 'SELECT schedule.* FROM schedule inner join class on schedule.class_id_fk = class.id inner join registration 
        on registration.class_id_fk = class.id 
        and registration.semester_id_fk = schedule.semester_id_fk where registration.student_id_fk = '.$_SESSION["userID"].'';
        
        $stmt = self::prepareStmt($query);  
        $sched = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $schedObj = new ScheduleModel($row['id']);
                $sched[$i] = $schedObj;
                $i++;
            }
        }
        return $sched;
    }

    public static function getAll(){
        $query = "SELECT schedule.* from schedule";
        $stmt = self::prepareStmt($query);
        
        $sched = array();
        $i=0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $schedObj = new ScheduleModel($row['id']);
                $sched[$i] = $schedObj;
                $i++;
            }
        }
        return $sched;

    }


}
