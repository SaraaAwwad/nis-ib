<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\RegisterationModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StudentModel;


use PHPMVC\LIB\InputFilter;

class RegisterationController extends AbstractController
{
    use InputFilter;

    public function defaultAction()
    {
        //$lvl = LevelModel::getAll();
        //$this->_data['levels'] = $lvl;
        $this->_data['details'] = RegisterationModel::getAll();
        $this->_view();
    }

    public function addAction()
    {
        $grade = SclGradeModel::getAll();
        $this->_data['grade'] = $grade;

        if(isset($_POST['action']))
        {
            if($_POST['action']=='getStudents'){
                $students = StudentModel::getStudents($_POST['grade']);
                echo json_encode($students);
                return;
            }
            if($_POST['action']=='getClass'){
                $class = ClassModel::getBy(array('grade_id_fk'),array($_POST['grade']));
                echo json_encode($class);
                return;
            }

        }

        $this->_view();

    }
}
?>