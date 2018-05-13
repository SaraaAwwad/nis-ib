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
use PHPMVC\Models\RoomModel;
use PHPMVC\Models\ErrorModel;

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

            $grade = $_POST['grade'];

            if(!empty($_POST['studentsCB'])){

                $c = RoomModel::getMinCapacity($class, $sem);
                if($c !== false){
                    if(count($_POST['studentsCB']) > $c){
                        $err = RoomModel::ERR_CAPACITY;
                        $_SESSION["message"][] = ErrorModel::getError($err);
                        $this->redirect("/registeration/add");
                    }
                }

                foreach($_POST['studentsCB'] as $selected){
                    $register = new RegisterationModel();
                    $date =  date("Y/m/d");
 
                    if(StudentModel::regValid($grade, $sem, $selected)){ 
                        $err = RegisterationModel::SUCCESS_REG;
                        $_SESSION["message"][] = ErrorModel::getError($err); 
                        $register->semester_id_fk = $sem;
                        $register->student_id_fk = $selected;
                        $register->class_id_fk = $class;
                        $register->datetime  = $date;
                        $register->save();
                     }
                }
        
                if(isset($_SESSION["message"])){
                    $this->message = $_SESSION["message"];
                }
            }

            $this->redirect('/registeration');
        }

        if(isset($_POST['action'])){
            if($_POST['action'] == 'getClasses'){
                $g = $_POST['grade'];
                $sem = $_POST['semester'];
                $class = ClassModel::getClassesByGrade($g);

                 $students = StudentModel::getNonRegisteredStudents($g, $sem);

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

    public function deleteAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            if(RegisterationModel::deleteReg($id)){
                $this->redirect("/registeration");
            }
        }
    }
}
?>