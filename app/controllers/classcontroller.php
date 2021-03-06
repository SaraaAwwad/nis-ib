<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\ErrorModel;

class ClassController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['class'] = ClassModel::getClasses();
        $this->_view();
    }

    public function addAction()
    {   
    	if(isset($_POST['addclass']))
    	{
            $class = new ClassModel();
            $class->name = $this->filterString($_POST['name']);
            $class->grade_id_fk = $this->filterInt($_POST['grade']);
            $class->status_id_fk = $this->filterInt($_POST['status']);
            
            if($class->isClassExist()){
                $err = ClassModel::ERR_EXIST;
                $_SESSION["message"][] = ErrorModel::getError($err);
            }  
            else if($class->save()){
                $err = ClassModel::SUCCESS_ADD;
                $_SESSION["message"][] = ErrorModel::getError($err);
                $this->redirect('/class');
            }   
        }
        
        if(isset($_SESSION["message"])){
            $this->message = $_SESSION["message"];
        }
    
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['grade'] = SclGradeModel::getAll();
        $this->_view();
    }

    public function editAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 

            $class = ClassModel::getByPK($id);
            $this->_data['class'] = $class;

            if(isset($_POST['editclass'])){
                $class->name = $this->filterString($_POST['name']);
                $class->grade_id_fk = $this->filterInt($_POST['grade']);
                $class->status_id_fk = $this->filterInt($_POST['status']);
                
                if($class->isClassExist()){
                    $err = ClassModel::ERR_EXIST;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                }  
                else if($class->save()){
                    $err = ClassModel::SUCCESS_ADD;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                    $this->redirect('/class');
                }  

                if(isset($_SESSION["message"])){
                    $this->message = $_SESSION["message"];
                }

            }
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['grade'] = SclGradeModel::getAll();
        $this->_view();
        }
    }
  
}