<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SeasonModel;
use PHPMVC\Lib\Helper;
class SemesterController extends AbstractController
{   use Helper;

    public function defaultAction(){
        $sem = SemesterModel::getSemesters();
        $this->_data['semester'] = $sem;
        $this->_view();
    }

    public function addAction(){
        if(isset($_POST['addsemester'])){
            $s = new SemesterModel();
            $s->year = $_POST['year'];
            $s->start_date = $_POST['start_date'];
            $s->end_date = $_POST['end_date'];
            $s->season_id_fk = $_POST['season'];
            if($s->save()){
                $this->redirect("\semester");
            }
        }
        
        $this->_data['season'] = SeasonModel::getAll();
        $this->_view();
    }

    public function editAction()  
   {  
    if(isset($this->_params[0])){
        $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 

        $s = SemesterModel::getByPK($id);

        if(isset($_POST['editsemester'])){
            $s->year = $_POST['year'];
            $s->start_date = $_POST['start_date'];
            $s->end_date = $_POST['end_date'];
            $s->season_id_fk = $_POST['season'];
            if($s->save()){
                $this->redirect("\semester");
            }
        }

        $this->_data['semester'] = $s;
        //$this->_data['year'] = 2019;        
        $this->_data['season'] = SeasonModel::getAll();

        $this->_view();
    }  
   }
  
}