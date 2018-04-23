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

    public function defaultAction()
    {
        //$lvl = LevelModel::getAll();
        //$this->_data['levels'] = $lvl;
        $this->_data['details'] = RegisterationModel::getReg();
        $this->_view();
    }

    public function addAction()
    {
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
        if(isset($_POST['action']))
        {
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
}
?>