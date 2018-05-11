<?php

namespace PHPMVC\Controllers;

use PHPMVC\Models\ExamModel;
use PHPMVC\Models\ExamRegistrationModel;
use PHPMVC\Models\GradeModel;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SlotModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\RoomModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\WeekdaysModel;


class ExamController extends AbstractController
{

    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['exams'] = ExamModel::getExams();
        $this->_view();
    }

    public function addAction(){
//        if(isset($this->_params[0])) {
//            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
//            $exam = ExamModel::getByPK($id);

            if(isset($_POST['action']))  {
                if($_POST['action']== 'getCourse'){
                    $course = $_POST['course'];
                    $grade = $_POST['grade'];
                    $students =  ExamModel::getStudentsInCourse($course,$grade);
                    echo json_encode($students);
                    return;
                } else if($_POST['action'] == 'getStudents'){

                    $students = $_POST['students'];
                    $output = ExamModel::getDates($students);
                    echo json_encode($output);
                    return;
                }else if($_POST['action'] == 'getRooms'){
                    $slot = $_POST['slot'];
                    $date = $_POST['date'];
                    $output = RoomModel::getExamRooms($date,$slot);
                    echo json_encode($output);
                    return;

                }else if($_POST['action'] == 'getCourseByGrade'){
                    $grade = $_POST['grade'];
                    $courses = CourseModel::getByGrade($grade);
                    echo json_encode($courses);
                    return;
                }
//                else if($_POST['action'] == 'getSlots'){
//                    $students = $_POST['students'];
//                    $day = $_POST['day'];
//                    $date = $_POST['date'];
//                    $output = $exam->getSlots($students,$day,$date);
//                    echo json_encode($output);
//                    return;
//                }
            }
            if(isset($_POST['addDetail'])){

                $exam = new ExamModel();
                $exam_reg = new ExamRegistrationModel();

                $exam->grade_id_fk = $_POST['grade'];
                $exam->course_id_fk = $_POST['course'];
                $exam->slot_id_fk = $_POST['slot'];
                $exam->room_id_fk = $_POST['room'];
                $exam->day_id_fk = $_POST['day'];
                $exam->status_id_fk = $_POST['status'];
                $exam->semester_id_fk = $_POST['semester'];
                $exam->date = $_POST['dateinput'];
                $students = $_POST['students'];
                $exam->save();

                foreach ($students as $st)
                {   $exam_reg->user_id_fk = $st;
                    $exam_reg->exam_id_fk = $exam->id;
                    $exam_reg->save();
                }

                $this->redirect('/exam');
            }

            $this->_data['grades'] = GradeModel::getAll();
            $this->_data['days'] = WeekdaysModel::getAll();
            $this->_data['slots'] = SlotModel::getAll();
            $this->_data['status'] = StatusModel::getAll();
            $this->_data['semesters'] = SemesterModel::getSemesters();
            $this->_view();
        //}
    }

    public function detailsAction(){
        if(isset($this->_params[0])) {
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
            $this->_data['students'] = UserModel::getStudents($id);
        }
        $this->_view();
    }

//    public function editAction()
//    {
//        if (isset($this->_params[0])) {
//            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
//            $exam = ExamModel::getByPK($id);
//            if ($exam === false) {
//                $this->redirect('/exam/default');
//            }
//            $salary = SalaryModel::getByUser($id);
//            $this->_data['users'] = $user;
//            $this->_data['salary'] = $salary;
//            $this->_data['grades'] = GradeModel::getAll();
//            $this->_data['courses'] = CourseModel::getAll();
//            $this->_data['days'] = WeekdaysModel::getAll();
//            $this->_data['slots'] = SlotModel::getAll();
//            $this->_data['status'] = StatusModel::getAll();
//            $this->_data['semesters'] = SemesterModel::getSemesters();
//
//            if (isset($_POST['edit'])) {
//                $user->type_id = $this->filterInt($_POST['professioninput']);
//                $user->fname = $this->filterString($_POST['fnameinput']);
//                $user->lname = $this->filterString($_POST['lnameinput']);
//                $user->gender = $this->filterString($_POST['radioinput']);
//                $user->DOB = $_POST['dateinput'];
//                $user->username = $this->filterString($_POST['usernameinput']);
//                $user->email = $this->filterString($_POST['emailinput']);
//                $user->status = $this->filterInt($_POST['statusinput']);
//                $user->user_id_fk = $this->filterInt(0);
//                $user->add_id_fk = $this->filterInt($_POST['street']);
//                $user->phone = $this->filterInt($_POST['numberinput']);
//                if (isset($_FILES["imageinput"]["name"])) {
//                    $uploader = new FileUpload($_FILES['imageinput']);
//                    $uploader->upload();
//                    $user->img = $uploader->getFileName();
//                }
//                $user->save();
//
//                $salary->amount = $this->filterInt($_POST['salaryinput']);
//                $salary->currency_id = $this->filterInt($_POST['currencyinput']);
//                $salary->save();
//
//
//                $this->redirect('/staff/default');
//            }
//
//        }
//        $this->_view();
//    }

    public function activationAction()
    {
        if(isset($this->_params[0])) {
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
            $exam = ExamModel::getByPK($id);
            if($exam === false)
            { $this->redirect('/exam/default'); }
            if($exam->status_id_fk == StatusModel::getStatusID("active"))
            { $exam->status_id_fk = $this->filterInt(StatusModel::getStatusID("inactive"));}
            else{
                $exam->status_id_fk = $this->filterInt(StatusModel::getStatusID("active"));
            }
            $exam->save();
            $this->redirect('/exam/default');
            }
    }

}