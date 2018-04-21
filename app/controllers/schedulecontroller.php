<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ScheduleModel;
use PHPMVC\Models\ScheduleDetailsModel;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SlotModel;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\WeekdaysModel;
use PHPMVC\Models\RoomModel;
use PHPMVC\Models\UserModel;

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
        if(isset($_POST['addSchedule']))  {
            $schedule = new ScheduleModel();
            $schedule->class_id_fk = $_POST['name'];
            $schedule->semester_id_fk = $_POST['semester'];
            $schedule->status_id_fk = 1;
            //to do: check if there's a schedule already
            if($schedule->save()){
                $this->redirect('/schedule');
                //or redirect to the details
            }

         /*       $output = array(  
                    'back' => 'yes'  
                  );    
             echo json_encode($output);  
             return;
           */ 

        }
    
        $this->_data['class'] = ClassModel::getAll();
        $this->_data['semester'] = SemesterModel::getSemesters();
        $this->_view();
    }

    public function detailsAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $this->_data['details'] = ScheduleDetailsModel::getDetails($id);
            $this->_data['courses'] = CourseModel::getAll();
            $this->_data['slots'] = SlotModel::getAll();
            $this->_data['days'] = WeekdaysModel::getAll();
            $this->_data['rooms'] = RoomModel::getAll();
            $this->_data['teacher'] = UserModel::getTeachers();
            $this->_view();
        }
    }
  
}