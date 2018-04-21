<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\SclGradeModel;

class SclGradeController extends AbstractController
{
    public function defaultAction(){
        
        $this->_data['students'] = StudentModel::getAll();
        $this->_data['grade'] = SclGradeModel::getGrade();
        $this->_view();
    }
    public function addAction(){

        
        $this->_view();
    }

//     public function viewAction()  
//    {  
//       $id_grade = $_POST['id'];
//       $this->_data['datas']= AddressModel::getGrade(); 
//       $output = '<option value="">Select '.$_POST["grade"].'</option>'; 
//       foreach ($this->_data['datas'] as $row)  
//       {   
//          $output .= "<option value='".$row->id."'>".$row->grade_name."</option>";  
//       } 
//       echo $output;

    

//    }  

  
}