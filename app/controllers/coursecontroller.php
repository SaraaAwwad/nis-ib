<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class CourseController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['courses'] = CourseModel::getCourse();
        $this->_view();
    }

    public function addAction()
    {   
    	// if(isset($_POST['addclass']))
    	// {
        //     $class = new ClassModel();
        //     $class->name = $this->filterString($_POST['name']);
        //     $class->grade_id_fk = $this->filterInt($_POST['grade']);
        //     $class->status_id_fk = $this->filterInt($_POST['status']);

        //    if($class->save()){
        //         $this->redirect('\class');
        //     }   
    	// }
    
        // $this->_data['status'] = StatusModel::getAll();
        // $this->_data['grade'] = SclGradeModel::getAll();
        // $this->_view();
    }
  
}