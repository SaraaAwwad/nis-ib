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

                if ($objReg->update()){
                    $this->redirect("/registeration");
                }else{

                }
            }
            $this->_view();
        }
    }
}
?>