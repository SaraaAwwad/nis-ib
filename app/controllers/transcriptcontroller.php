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
        $this->_data['transcript'] = TranscriptModel::getTranscript($_SESSION["userID"]);
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

                $transObj->add();
            }
            exit();
            //$course = $_POST['course'];
            //$sem = $_POST['semester'];
            
           /* if(!empty($_POST['students'])){

                foreach($_POST['students'] as $ss){
                    
                   $trans = new TranscriptModel();
                   $trans->user_id_fk = $ss->name;
                   $trans->semester_id_fk = $_POST['semester'];
                   $trans->NumericGrade = $ss;
                   $trans->course_id_fk = $_POST['course'];
                   if($ss < 4){
                       $trans->LetterGrade = 'F';}
                       else if($ss == 4){
                        $trans->LetterGrade = 'D';}
                       else if($ss == 5){
                        $trans->LetterGrade = 'C';}
                       else if($ss == 6){
                        $trans->LetterGrade = 'B';}
                        else if($ss == 7){
                            $trans->LetterGrade = 'A';}

                   $trans->save();
                
                }
            }*/

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
                $semesters = SemesterModel::getSemestersByCourse($course);
                echo json_encode($semesters);
                return;
            }

            else if($_POST['action'] == 'getStudents'){
                $semester = $_POST['semester'];
                $grade = $_POST['grade'];
                $course = $_POST['course'];
                $students = ExamModel::getStudentsInCourse($course,$grade);
                $maxgrade = ExamModel::getOutOfGrade($course, $semester);
                $output = array("students"=> $students, "maxgrade" => $maxgrade);
                echo json_encode($output);
                return;
            }
        }

        $this->_data['grade'] = GradeModel::getAll();
       //??? $this->_data['semester'] = SemesterModel::getSemesters();
        $this->_view();
        }
    }