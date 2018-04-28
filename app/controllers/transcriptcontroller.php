<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\RegisterationModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\ClassModel;
use PHPMVC\Models\CourseModel;

use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Lib\Helper;


class TranscriptController extends AbstractController
{   use Helper;
    use InputFilter;

    public function defaultAction(){
       // $this->_data['']
    }

    public function addAction(){

        $semester = SemesterModel::getSemesters();
        $grade = SclGradeModel::getAll();
        
        $this->_data['semester'] = $semester;
        $this->_data['grade'] = $grade;

        if(isset($_POST['addTran'])){

            $course = $_POST['course'];
            $sem = $_POST['semester'];

            if(!empty($_POST['studentsCB'])){
                foreach($_POST['studentsCB'] as $gr){
                   $trans = new TranscriptModel();
                   $trans->semester_id_fk = $sem;
                   $trans->NumericGrade = $gr;
                   $trans->course_id_fk = $course;
                   $trans->save();
                }

            }
            $this->redirect('/transcript');
        }

        if(isset($_POST['action']))
        {
            if($_POST['action'] == 'getCourses'){
                $g = $_POST['grade'];
                $courses = CourseModel::getCourseByGrade($g);

                echo json_encode($courses);
                return;
            }
        }

        $this->_view();
        }
    }
