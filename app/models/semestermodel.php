<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\SemesterPricesModel;

class SemesterModel extends AbstractModel{
    public $id;
    public $year;
    public $season_id_fk;
    public $start_date;
    public $end_date;
    public $season_name;

    public $prices = array();

    protected static $tableName = 'semester';
    protected static $tableSchema = array(
        'id'                  => self::DATA_TYPE_INT,
        'year'               => self::DATA_TYPE_INT,
        'season_id_fk'          => self::DATA_TYPE_INT,
        'start_date'           => self::DATA_TYPE_DATE,
        'end_date'           => self::DATA_TYPE_DATE        
    );
    protected static $primaryKey = 'id';
    public static function getSemesters(){
        return self::get(
        'SELECT semester.*, season.season_name FROM ' . self::$tableName . ' INNER JOIN
          season ON semester.season_id_fk = season.id'
        );
    }

    public function __construct($id=""){
        if($id != ""){
            $this->id = $id;
            $this->getInfo();
        }
        $this->getAllPrices();
    }
    public function getInfo(){
        $query = "SELECT semester.*, season.season_name FROM semester INNER JOIN
        season ON semester.season_id_fk = season.id where semester.id = :id";

        $stmt = $this->prepareStmt($query);  
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->year = $row['year'];
            $this->season_name = $row['season_name'];
            $this->start_date = $row['start_date'];
            $this->end_date = $row['end_date'];
        }
        //$this->getFees();
    }

    public static function getSemestersByCourse($course){
        $sql = "SELECT DISTINCT semester.* from semester
        INNER JOIN schedule ON schedule.semester_id_fk = semester.id INNER JOIN 
        schedule_details ON schedule_details.sched_id_fk = schedule.id 
        INNER JOIN course ON schedule_details.course_id_fk = '$course'";
        $stmt = self::prepareStmt($sql);
        $sem = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $se = new SemesterModel($row['id']);
                $sem[$i] = $se;
                $i++;
            }
        }
        return $sem;
    }

    public static function getNonTranscriptedSemesters($course){
        $sql = "SELECT exam_details.semester_id_fk FROM exam_details WHERE  exam_details.semester_id_fk NOT IN ( select semester_id_fk from transcript)
        AND exam_details.course_id_fk = :course";

        $stmt = self::prepareStmt($sql);
        $stmt->bindParam(':course', $course);

        $Semesters = array();
        $i=0;

        if ($stmt->execute()){
           while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){ 
                $semObj = new SemesterModel($row["semester_id_fk"]);
                $Semesters[$i] = $semObj;
                $i++;
            }
            return $Semesters;
        }else{
            return false;
        }

    }

    public function add(){

        $query = "INSERT INTO
        semester(year, season_id_fk, start_date, end_date)
        VALUES (:year, :season_id_fk, :start_date, :end_date)";

        $stmt = self::prepareStmt($query);

        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":season_id_fk", $this->season_id_fk);
        $stmt->bindParam(":start_date", $this->start_date);                
        $stmt->bindParam(":end_date", $this->end_date);        

        if($stmt->execute()){
            $this->id = self::getLastId(); 
            return self::getLastId();
        }

        return false;
    }

    public function getAllPrices(){
        $grades =  SclGradeModel::getAll();
        $i=0;
        foreach($grades as $g){
            $this->prices[$i] =  new SemesterPricesModel($this->id,$g->id);
            $i++;
        }
    }

    public function edit(){
        $sql = "UPDATE semester SET year = :year, season_id_fk = :season_id_fk, start_date = :start_date, end_date =:end_date
        WHERE id = :id";
        
        $stmt = self::prepareStmt($sql);  

        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT); 
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':season_id_fk', $this->season_id_fk);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
    
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function isExist(){
        $sql = "SELECT * FROM semester Where id = :id";

        $stmt = self::prepareStmt($sql); 
        $id = self::test_input($this->id);

        $stmt->bindParam(':id', $this->id);         

        if($stmt->execute()){
            $numofrows =  $stmt->rowCount();
        }
        if($numofrows > 0 ) {
            return $stmt;
        }else{
            return false;

        }
    }

    public static function count($semester){
        $query = "SELECT COUNT(id) FROM registration WHERE semester_id_fk = '.$semester.'";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            $num_rows = $stmt->fetchColumn();
            return intval($num_rows);
        }else{
            return false;
        }
    }

    public static function sumAmount($decorator){
        $query = "SELECT SUM(payment_detail.amount) as 'Total' FROM payment_detail
                    INNER JOIN decorator on decorator.id = payment_detail.decorator_id_fk
                    WHERE decorator.name = '$decorator'";
        $stmt = self::prepareStmt($query);
        if ($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['Total'];
        }else{
            return false;
        }
    }


}