<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;


class StudentModel extends UserModel{

    public $concatenate = "@nis.edu.eg";
    public $gradeObj;
    public $paymentObj;               // array of all payments
    public $current_semester_status;  // paid 0 - 1
    public $pid;                      // payment id of current semester
    public $sem_status;               // current semester payment status

    public function __construct($id=""){
         if($id != ""){
             $this->id = $id;
             $this->getInfo();
         }
    }

    
    public function getInfo(){

        $query = "SELECT * FROM user WHERE id = :id";

        $stmt = self::prepareStmt($query);
        $this->id = self::test_input($this->id);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
              $this->id = $row["id"];
              $this->fname = $row["fname"];
              $this->lname = $row["lname"];
              $this->gender = $row["gender"];
              $this->DOB = $row["DOB"];
              $this->password = $row["pwd"];
              $this->username = $row["username"];
              $this->email = $row["email"];
              $this->phone = $row["phone"];
              $this->status = $row["status"];
              $this->user_id_fk = $row["user_id_fk"];
              $this->img = $row["img"];
              $this->add_id_fk = $row["add_id_fk"];
              $this->paymentObj = PaymentModel::getPayment($row['id']);
            }
        }  
    }

    public static function getAll(){

        $sql ="SELECT users.*,
       parent.fname as 'parent_fname',
       parent.lname as 'parent_lname',
       parent.phone as 'parent_phone',
       parent.email as 'parent_email',
       status.code,
       scl_grade.grade_name
       FROM user AS users JOIN user AS parent 
       ON parent.id = users.user_id_fk INNER JOIN status ON users.status = status.id
       INNER JOIN student_level ON student_level.user_id_fk = users.id
       INNER JOIN scl_grade ON student_level.scl_grade_id_fk = scl_grade.id
       WHERE users.user_id_fk != 0 ORDER BY users.id ASC";
        $result = self::prepareStmt($sql);
        $Res = array();
        $i=0;
        if($result->execute()) {
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $MyObj = new StudentModel($row["id"]);
                $MyObj->code = $row["code"];
                $MyObj->parent_fname = $row["parent_fname"];
                $MyObj->parent_lname = $row["parent_lname"];
                $MyObj->parent_phone = $row["parent_phone"];
                $MyObj->parent_email = $row["parent_email"];
                $MyObj->grade_name = $row["grade_name"];
                $Res[$i] = $MyObj;
                $i++;
            }
            return $Res;
        }else {
            return false;

        }
    }

    public static function insertInDB($stud){
        $db = DatabaseHandler::getConnection();
        $sql = "INSERT INTO user (type_id, fname, lname, gender, DOB, username, pwd, email, status, img, user_id_fk, add_id_fk, phone) 
        VALUES ('1', '$stud->fname','$stud->lname','$stud->gender', '$stud->DOB', '$stud->username', '$stud->password', '$stud->email', '$stud->status', '$stud->img','$stud->user_id_fk','$stud->address_id_fk','$stud->phone')";

        if (mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
        // die(mysqli_error($db));
        }
    }

    public static function getByPK($id)
    {
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = self::prepareStmt($sql);
        if ($result->execute()) {
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $MyObj = new StudentModel($row["id"]);
            }
            return $MyObj;
        }
    }

    public function update(){
        $sql = "UPDATE user SET fname= '$this->fname' ,lname='$this->lname', DOB='$this->DOB', phone = '$this->phone',
         gender='$this->gender', email='$this->email'
        , status = '$this->status', pwd = '$this->password', username = '$this->username', img = '$this->img' WHERE id='$this->id'";
        $stmt = self::prepareStmt($sql);
        if($stmt->execute()){
                    return true;
                }else{
                   return false;
                }
    }

    //aggregates Scl_grade class
    public function getGrade(){

        $query = "SELECT scl_grade_id_fk from student_level WHERE user_id_fk = ". $this->id;
        $stmt = self::prepareStmt($query);

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $this->gradeObj = new SclGradeModel($row['scl_grade_id_fk']);
            }
            return true;
        }else{
            return false;
        }

    }

    public static function getNonRegisteredStudents($grade_id_fk, $semester_id_fk){

        $sql = "SELECT user.* from user INNER JOIN student_level ON user.id = student_level.user_id_fk INNER JOIN status
        ON status.id= user.status INNER JOIN payment ON payment.user_id_fk = user.id INNER JOIN payment_status
        ON payment.status_id_fk = payment_status.id WHERE status.code = :active AND 
        student_level.scl_grade_id_fk = :grade AND  payment_status.code = :approved AND payment.semester_id_fk = :semester
        AND  user.id NOT IN (select student_id_fk FROM registration WHERE registration.semester_id_fk = :regsemester)";

        $stmt = self::prepareStmt($sql);
        $grade_id_fk = self::test_input($grade_id_fk);
        $semester_id_fk = self::test_input($semester_id_fk);

        $active = StatusModel::ACTIVE;
        $approved = PaymentModel::APPROVED;

        $stmt->bindParam(":active", $active);
        $stmt->bindParam(":approved", $approved);
        $stmt->bindParam(":grade", $grade_id_fk);
        $stmt->bindParam(":semester", $semester_id_fk);
        $stmt->bindParam(":regsemester", $semester_id_fk);

        $Students = array();
        $i = 0;

        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $studObj = new StudentModel($row["id"]);
                $Students[$i] = $studObj;
                $i++;        
            }
            return $Students;
        }else{
            return false;
        }
    
    }

    public static function getStudentsBySemester($semester){
        $query = "SELECT user.fname FROM user 
        INNER JOIN registration ON registration.student_id_fk = user.id
        INNER JOIN semester ON registration.semester_id_fk = $semester";

        $stmt = self::prepareStmt($query);
        $stud = array();
        $i=0;
        if($stmt->execute()){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $st = new StudentModel($row['id']);
                $stud[$i] = $st;
                $i++;
            }
        }
        return $stud;
    }

    public static function getStudentsBySemAndCourse($sem, $course){
        $query = "SELECT user.* FROM user inner join registration on  registration.student_id_fk = user.id inner join 
        class on registration.class_id_fk = class.id inner join schedule on schedule.class_id_fk = class.id 
        inner join  schedule_details on schedule_details.sched_id_fk = schedule.id
        where registration.semester_id_fk = :sem and schedule.semester_id_fk = :sem and schedule_details.course_id_fk = :course";

        $stmt = self::prepareStmt($query); 

        $stmt->bindParam(':sem', $sem);         
        $stmt->bindParam(':course', $course); 
        $Stud = array();
        $i=0;

        if($stmt->execute()){
           while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $s = new StudentModel($row["id"]);
            $Stud[$i] = $s;
            $i++;
           }
           return $Stud;
        }else{
            return false;
        }        

    }

    public static function regValid($grade_id_fk, $semester_id_fk, $student_id_fk){
        $sql = "SELECT user.* from user INNER JOIN student_level ON user.id = student_level.user_id_fk INNER JOIN status
        ON status.id= user.status INNER JOIN payment ON payment.user_id_fk = user.id INNER JOIN payment_status
        ON payment.status_id_fk = payment_status.id WHERE status.code = :active AND 
        student_level.scl_grade_id_fk = :grade AND  payment_status.code = :approved AND payment.semester_id_fk = :semester AND
        user.id = :student_id_fk 
        AND  user.id NOT IN (select student_id_fk FROM registration WHERE registration.semester_id_fk = :regsemester)";

        $stmt = self::prepareStmt($sql);
        $grade_id_fk = self::test_input($grade_id_fk);
        $semester_id_fk = self::test_input($semester_id_fk);
        $student_id_fk = self::test_input($student_id_fk);

        $active = StatusModel::ACTIVE;
        $approved = PaymentModel::APPROVED;

        $stmt->bindParam(":active", $active);
        $stmt->bindParam(":approved", $approved);
        $stmt->bindParam(":grade", $grade_id_fk);
        $stmt->bindParam(":semester", $semester_id_fk);
        $stmt->bindParam(":regsemester", $semester_id_fk);
        $stmt->bindParam(":student_id_fk", $student_id_fk);

        $Students = array();
        $i = 0;

        if($stmt->execute()){
            $numofrows =  $stmt->rowCount();
        }else{
            return false;
        }

        if($numofrows > 0 ){
            return true;
        }else{
            return false;
        }
    
    }

}


