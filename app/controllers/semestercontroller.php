<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SeasonModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\CurrencyModel;
use PHPMVC\Models\SemesterPricesModel;
class SemesterController extends AbstractController
{   use Helper;

    public function defaultAction(){
        $sem = SemesterModel::getSemesters();
        $this->_data['semester'] = $sem;
        $this->_view();
    }

    public function addAction(){
        $this->_data['currency'] = CurrencyModel::getAll();
        $grades =  SclGradeModel::getAll();
        $this->_data['grades'] = $grades;

        if(isset($_POST['addsemester'])){
            $s = new SemesterModel();
            $s->year = $_POST['year'];
            $s->start_date = $_POST['start_date'];
            $s->end_date = $_POST['end_date'];
            $s->season_id_fk = $_POST['season'];
            $s->add();
  
            $currency = $_POST["currency"];
            $price = $_POST["price"];

            $arr_length = count($currency);
            $i=0;      
            for($i=0; $i<$arr_length; $i++){    
                 $scl_grade_id_fk = $grades[$i]->id;
                 SemesterPricesModel::add($s->id, $currency[$i], $price[$i], $scl_grade_id_fk);  
            }
            
            $this->redirect("/semester");
        }
        
        $this->_data['season'] = SeasonModel::getAll();

        $this->_view();
    }

    public function editAction()  {  
    if(isset($this->_params[0])){
        $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 

        $s = new SemesterModel($id);

        if(isset($_POST['editsemester'])){
            $s->year = $_POST['year'];
            $s->start_date = $_POST['start_date'];
            $s->end_date = $_POST['end_date'];
            $s->season_id_fk = $_POST['season'];
            $s->edit();

        $currency = $_POST["currency"];
        $price = $_POST["price"];
        
        $arr_length = count($currency);
       $i=0; 

        for($i=0; $i<$arr_length; $i++){    
            $priceid = $s->prices[$i]->id;
            SemesterPricesModel::edit($priceid, $currency[$i], $price[$i]);  
        }
        $this->redirect("/semester");
    }

        $this->_data['semester'] = $s;       
        $this->_data['season'] = SeasonModel::getAll();
        $this->_data['currency'] = CurrencyModel::getAll();
        $this->_view();
    }  
   }
  
}