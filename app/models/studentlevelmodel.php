<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class StudentLevelModel extends AbstractModel{
    public $id;
    public $scl_grade_id_fk; //use grade only
    public $user_id_fk;
    private $conn;
    private $table_name = "student_level";

    public function __construct($id=""){
        $this->conn = DatabaseHandler::getConnection();
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id)
    {
        if ($stmt = $this->conn->prepare("SELECT * FROM student_level WHERE id = ?")) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                var_dump($result);
                while ($row = $result->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->scl_grade_id_fk = $row["scl_grade_id_fk"];
                    $this->user_id_fk = $row["user_id_fk"];
                }

            }
        }
    }

//    public function getGrade($id_fk){
//
//        if ($stmt = $this->conn->prepare("SELECT * FROM student_level WHERE id = ?")) {
//
//            $input_id=htmlspecialchars(strip_tags($id_fk));
//            $stmt->bind_param("i", $input_id);
//            if($stmt->execute()){
//                $result = $stmt->get_result();
//                $Res = array();
//                $i=0;
//                while ($row = $result->fetch_assoc()) {
//                    //var_dump($row['id']);
//                    $StudentLevelObj = new StudentLevelModel($row['id']);
//                    var_dump($StudentLevelObj);
//                    $Res[$i] = $StudentLevelObj;
//                    $i++;
//                }
//                return $Res;
//                }
//        }else{
//            return false;
//        }
//
//    }

    static function getGrades($fk)
    {

//        return self::getArr('SELECT * FROM' . self::$tableName . 'WHERE user_id_fk =');
//        $sql= 'SELECT * FROM :tableName WHERE user_id_fk =:userid_fk';
//        $stmt = $this->conn->prepare($query);

    }
//    public function InsertinDB(){
//
//        $sql = "INSERT INTO student_level (scl_level_id_fk, scl_grade_id_fk,user_id_fk)
//                VALUES ($this->scl_level_id, $this->scl_grade_id,$this->user_id)";
//        $db = DatabaseHandler::getConnection();
//        $result = mysqli_query($db,$sql);
//        if($result){
//            return true;
//        }else{
//            return false;
//        }
//    }

}