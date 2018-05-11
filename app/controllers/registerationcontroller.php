<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\RegisterationModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Lib\Helper;

class RegisterationController extends AbstractController
{   use Helper;
    use InputFilter;

    public function defaultAction(){
        $this->_data['details'] = RegisterationModel::getReg();
        $this->_view();
    }

    public function addAction(){

        $grade = SclGradeModel::getAll();
        $semester = SemesterModel::getSemesters();
        $this->_data['semester'] = $semester;
        $this->_data['grade'] = $grade;


        if(isset($_POST['addReg'])){

            $class = $_POST['class'];

            $sem = $_POST['semester'];
            
            if(!empty($_POST['studentsCB'])){
                foreach($_POST['studentsCB'] as $selected){
                   $register = new RegisterationModel();
                   $date =  date("Y/m/d");
                   $register->semester_id_fk = $sem;
                   $register->student_id_fk = $selected;
                   $register->class_id_fk = $class;
                   $register->datetime  = $date;
                   $register->save();
                }

            }

            $this->redirect('/registeration');
        }

        if(isset($_POST['action'])){
            if($_POST['action'] == 'getClasses'){
                $g = $_POST['grade'];
                $sem = $_POST['semester'];
                $class = ClassModel::getClassesByGrade($g);

                //want students who paid for this semester and are in this grade and are not already registered.
                $students = StudentModel::getNonRegisteredStudents($g, $sem);
          /* SELECT user.* from user INNER JOIN student_level ON user.id = student_level.user_id_fk INNER JOIN status
        ON status.id= user.status INNER JOIN payment ON payment.user_id_fk = user.id INNER JOIN payment_status
        ON payment.status_id_fk = payment_status.id WHERE status.code = "active" AND 
        student_level.scl_grade_id_fk = 1 AND  payment_status.code = "approved" AND payment.semester_id_fk = 1
        AND  user.id NOT IN (select student_id_fk FROM registration WHERE registration.semester_id_fk = 1)*/
                $output = array(
                    'class' => $class, 
                    'students' => $students
                );        
                echo json_encode($output);
                return;
            }
        }

        $this->_view();

    }

    public function editAction(){

        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
            $reg = new RegisterationModel();
            $regist = $reg->getInfo($id);

            if($regist == false){
                $this->redirect("/registeration");
            }

            //to send to view
            $this->_data['regist'] = $regist;

            if(isset($_POST['updateReg'])){
                $objReg = new RegisterationModel($id);
                $objReg->student_id = $_POST['st_id'];
                $objReg->class_id = $_POST['cl_id'];
                $objReg->datetime = $_POST['dt'];
                $objReg->Semester_id_fk = $_POST['sem_id'];

//                if ($objReg->save()){
//                    $this->redirect("/registeration");
//                }else{
//
//                }
            }
            $this->_view();
        }
    }
}
?>