<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\RegisterationModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\GradeModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\TranscriptModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Models\ExamModel;

class TranscriptController extends AbstractController
{   use Helper;
    use InputFilter;
    public function defaultAction(){

        $student = new StudentModel($_SESSION["userID"]);

        //$this->_data['transcript'] = TranscriptModel::getStudentTranscript($_SESSION["userID"]);
        $semArr = TranscriptModel::getStudentSemesters($student);
        $transArr = array();
        $i=0;
        foreach($semArr as $sem){
            $transArr[$i] =  TranscriptModel::getBySemester($sem, $student);
            $i++;
        }
        
        $this->_data['transcript'] = $transArr;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['addTran'])){

            $grades = $_POST['grades'];
            $course = $_POST['course'];
            $sem = $_POST['semester'];

            foreach($grades as $g){
                //1st check they're all under the maximum limit
                $maxgrade = ExamModel::getOutOfGrade($course, $sem);
                if($g > $maxgrade){
                    //exit with error message;
                    $this->redirect("/transcript");
                }
            }

            $students = StudentModel::getStudentsBySemAndCourse($sem, $course);
            $i=0;
            foreach($grades as $g){

                $date = date("Y/m/d");
                $transObj = new TranscriptModel("");
                $transObj->course_id_fk = $course;
                $transObj->semester_id_fk = $sem;
                $transObj->NumericGrade = $g;
                $transObj->date = $date;
                $transObj->user_id_fk = $students[$i]->id;
                $i++;
                $transObj->add();
            }
            $this->redirect('/transcript');
        }

        if(isset($_POST['action'])){

            if($_POST['action'] == 'getCourses'){
                $grade = $_POST['grade'];
                $courses = CourseModel::getCourseByGrade($grade);
                echo json_encode($courses);
                return;
            }
            
            else if($_POST['action'] == 'getSemesters'){
                $course = $_POST['course'];
                //search the courses that had exams this semester (check exist), and that its transcript is not computed yet
                $semesters = SemesterModel::getNonTranscriptedSemesters($course);
                echo json_encode($semesters);
                return;
            }

            else if($_POST['action'] == 'getStudents'){
                $semester = $_POST['semester'];
                $grade = $_POST['grade'];
                $course = $_POST['course'];
                $students = StudentModel::getStudentsBySemAndCourse($semester, $course);
                $maxgrade = ExamModel::getOutOfGrade($course, $semester);
                $output = array("students"=> $students, "maxgrade" => $maxgrade);
                echo json_encode($output);
                return;
            }
        }

        $this->_data['grade'] = GradeModel::getAll();
        $this->_view();
    }

    public function viewAction(){
        $trans = TranscriptModel::getAll();
        $this->_data["trans"] = $trans;
        $this->_view();
    }

    public function editAction(){
        if(isset($this->_params[0]) && isset($this->_params[1])){
        
            $course = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $semester = filter_var($this->_params[1], FILTER_SANITIZE_NUMBER_INT);
          
            $trans = TranscriptModel::getBySemAndCourse($course, $semester);
            
            if(!$trans){
                $this->redirect("/transcript");
            }

            if(isset($_POST["editTranscript"])){
                $grades = $_POST['grades'];

                foreach($grades as $g){
                    //1st check they're all under the maximum limit
                    $maxgrade = ExamModel::getOutOfGrade($course, $semester);
                    if($g > $maxgrade){
                        //exit with error message;
                        $this->redirect("/transcript");
                    }
                } 
            
            $i=0;                
            
            foreach($grades as $g){
                $transObj = new TranscriptModel($trans[$i]->id);
                $date = date("Y/m/d");
                $transObj->NumericGrade = $g;
                $transObj->date = $date;
                $i++;
                $transObj->edit();
            }
            $this->redirect('/transcript/view');
            }

            $maxgrade = ExamModel::getOutOfGrade($course, $semester);
            $this->_data["trans"] = $trans;
            $this->_data["maxgrade"] = $maxgrade;
            $this->_view();
        }
    }

}