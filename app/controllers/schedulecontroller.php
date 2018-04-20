<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ScheduleModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\ClassModel;
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
        if(isset($_POST['action']))  {
            $schedule = new ScheduleModel();
            $schedule->class_id_fk = $_POST['class'];
            $schedule->semester_id_fk = $_POST['semester'];
            $schedule->status_id_fk = 1;
            $schedule->save();

                $output = array(  
                    'back' => 'yes'  
                  );    
             echo json_encode($output);  
             return;
            

        }
    
        $this->_data['class'] = ClassModel::getAll();
        $this->_data['semester'] = SemesterModel::getSemesters();
        $this->_view();
    }
  
}