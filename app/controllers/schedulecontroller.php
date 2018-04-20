<?php
namespace PHPMVC\Controllers;

use PHPMVC\Models\ScheduleModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class ScheduleController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['schedule'] =ScheduleModel::getSchedules();
        $this->_view();
    }

    public function addAction()
    {   
    	/*if(isset($_POST['addclass']))
    	{
            $class = new ClassModel();
            $class->name = $this->filterString($_POST['name']);
            $class->grade_id_fk = $this->filterInt($_POST['grade']);
            $class->status_id_fk = $this->filterInt($_POST['status']);

           if($class->save()){
                $this->redirect('\class');
            }   
    	}
    
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['grade'] = SclGradeModel::getAll();
        $this->_view();*/
    }
  
}