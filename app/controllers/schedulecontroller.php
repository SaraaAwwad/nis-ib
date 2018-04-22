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
use PHPMVC\Models\StaffModel;

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

        }
    
        $this->_data['class'] = ClassModel::getAll();
        $this->_data['semester'] = SemesterModel::getSemesters();
        $this->_view();
    }

    public function detailsAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $s = ScheduleModel::getByPK($id);

            if(isset($_POST['action']))  {
                if($_POST['action']== 'getDays'){
                    $slot = $_POST['slot'];
                    $days =  $s->getFreeDays($slot);
                    echo json_encode($days);  
                    return;    
                }
    
                else if($_POST['action'] == 'getRooms'){
                    $slot = $_POST['slot'];
                    $day = $_POST['day'];    
                    $rooms = RoomModel::getFreeRooms($day, $slot, $s->semester_id_fk);
                    $teachers = StaffModel::getFreeTeachers($day, $slot, $s->semester_id_fk);
                    $output = array(
                        'rooms' => $rooms, 
                        'teachers' => $teachers
                    );
                    echo json_encode($output);
                    return;
                }
    
                else if($_POST['action'] == 'deleteDetail'){
                    $d_id = $_POST['id'];
                    $s = ScheduleDetailsModel::getByPK($d_id);
                    $del=false;
                    if($s->delete()){
                        $del = true;
                    }
                 $output = array(
                     'delete' => $del
                 );
                    echo json_encode($output);                
                    return;
                }
            }

            if(isset($_POST['addDetail'])){
                $sDetail = new ScheduleDetailsModel();
    
                $sDetail->sched_id_fk = $id;
                $sDetail->slot_id_fk = $_POST['slot'];
                $sDetail->course_id_fk = $_POST['course'];
                $sDetail->teacher_id_fk = $_POST['teacher'];
                $sDetail->room_id_fk = $_POST['room'];
                $sDetail->day_id_fk = $_POST['day'];
                $sDetail->save();
            }

            $this->_data['details'] = ScheduleDetailsModel::getDetails($id);
            $this->_data['courses'] = CourseModel::getAll();
            $this->_data['slots'] = SlotModel::getAll();
          
            $this->_view();
        }
    }

    public function deletedetailAction(){
        if(isset($this->_params[0])){
        $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
        $s = ScheduleDetailsModel::getByPK($id);
        $sched = $s->sched_id_fk;
            if($s->delete()){
                $this->redirect('/schedule/details/'.$sched);
            }
        }
    }
}