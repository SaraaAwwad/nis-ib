<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\AddressModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\CourseGroupModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputFilter;

class LevelController extends AbstractController{
    public function defaultAction(){
        
        $this->_data['students'] = StudentModel::getAll();
        $this->_data['usertype'] = UserTypesModel::getUsers();
        $this->_view();
    }
    public function addAction(){
        if(isset($_POST['addstudent'])){
            $level = new LevelModel();
            $level->lev_id_fk = $_POST['levelin'];
            $level->gr_id_fk = $_POST['grade'];
            
            //$level->user_id_fk
            if (LevelModel::insertInDb($level)){
                $this->redirect("\student");
            }else{
                
            }
        }
    }
}