<?php

namespace PHPMVC\Controllers;

use PHPMVC\Models\ExamModel;
use PHPMVC\Models\GradeModel;
use PHPMVC\Models\ScheduleModel;
use PHPMVC\Models\ScheduleDetailsModel;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SlotModel;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\RoomModel;
use PHPMVC\Models\StaffModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class ExamController extends AbstractController
{

    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['exams'] = ExamModel::getExams();
        $this->_view();
    }

    public function addAction()
    {
        if(isset($_POST['addExam']))  {
            $exam = new ExamModel();
            $exam->grade_id_fk = $_POST['gradename'];
            $exam->semester_id_fk = $_POST['semester'];
            $exam->status_id_fk = $_POST['status'];

            if($exam->isExist()){
                $this->redirect('/exam');
                //message = already added
            }

            if($exam->save()){
                $this->redirect('/exam');
            }

        }

        $this->_data['grade'] = GradeModel::getAll();
        $this->_data['semester'] = SemesterModel::getSemesters();
        $this->_data['status'] = StatusModel::getAll();
        $this->_view();
    }

    public function detailsAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
            $exam = ExamModel::getByPK($id);

            if(isset($_POST['action']))  {
                if($_POST['action']== 'getCourse'){
                    $course = $_POST['course'];
                    $students =  $exam->getStudentsInCourse($course);
                    echo json_encode($students);
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

            $s = ScheduleModel::getByPK($id);
            $s->getDetails();

            $this->_data['details'] = $s->sched_details; // ScheduleDetailsModel::getDetails($id);
            $this->_data['courses'] = CourseModel::getAll();
            $this->_data['slots'] = SlotModel::getAll();

            $this->_view();
        }
    }

    public function editAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);

            $exam = ExamModel::getByPK($id);
            if($exam){
                $this->_data['exams'] = $exam;
                if(isset($_POST['editExam'])){
                    $exam->grade_id_fk = $_POST['grade'];
                    $exam->status_id_fk = $_POST['status'];
                    $exam->semester_id_fk = $_POST['semester'];
                    if($exam->save()){
                        $this->redirect('/exam');
                    }
                }
                $this->_data['grade'] = GradeModel::getAll();
                $this->_data['semester'] = SemesterModel::getSemesters();
                $this->_data['status'] = StatusModel::getAll();

                $this->_view();
            }
        }
    }
}