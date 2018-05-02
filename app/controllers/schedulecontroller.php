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
        $this->_data['schedule'] =ScheduleModel::getAll();
        $this->_view();
    }

    public function addAction(){ 
        if(isset($_POST['addSchedule']))  {
            $schedule = new ScheduleModel();
            $schedule->class_id_fk = $_POST['name'];
            $schedule->semester_id_fk = $_POST['semester'];
            $schedule->status_id_fk = $_POST['status'];

            if($schedule->isExist()){
                $this->redirect('/schedule');
                //message = already added
            }

            if($schedule->add()){
                $this->redirect('/schedule');
            }

        }
    
        $this->_data['class'] = ClassModel::getAll();
        $this->_data['semester'] = SemesterModel::getSemesters();
        $this->_data['status'] = StatusModel::getAll();
        $this->_view();
    }

    public function detailsAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $s = new ScheduleModel($id);
            
           // $w = $s->getFreeDays(1);
           // var_dump($w);
            //exit();
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
            }

            if(isset($_POST['addDetail'])){
                $sDetail = new ScheduleDetailsModel();
    
                $sDetail->sched_id_fk = $id;
                $sDetail->slot_id_fk = $_POST['slot'];
                $sDetail->course_id_fk = $_POST['course'];
                $sDetail->teacher_id_fk = $_POST['teacher'];
                $sDetail->room_id_fk = $_POST['room'];
                $sDetail->day_id_fk = $_POST['day'];
                if($sDetail->save()){
                    $this->redirect('/schedule/details/'.$id.'');
                }

            }

            //$s = ScheduleModel::getByPK($id);
            //$s->getDetails();

            $this->_data['details'] = $s->sched_details; // ScheduleDetailsModel::getDetails($id);
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

    public function editAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
            $s = new ScheduleModel($id);
          if($s){
            $this->_data['sched'] = $s;

            if(isset($_POST['editSched'])){
                $s->class_id_fk = $_POST['class'];
                $s->status_id_fk = $_POST['status'];
                $s->semester_id_fk = $_POST['semester'];
                
                if($s->edit()){
                    $this->redirect('/schedule');
                }
            }

            $this->_data['class'] = ClassModel::getAll();
            $this->_data['semester'] = SemesterModel::getSemesters();
            $this->_data['status'] = StatusModel::getAll();

            $this->_view();
          }
        }
    }

    public function studentAction(){
        $sched = ScheduleModel::getAllStudentSched();
        $this->_data['sched'] = $sched;
        $this->_view();
    }
}