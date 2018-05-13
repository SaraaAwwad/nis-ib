<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\GradeModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\Models\CourseGroupModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class CourseController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction(){
        $this->_data['course'] = CourseModel::getAll();
        $this->_view();
    }

    public function addAction(){   

        $this->_data['status'] = StatusModel::getAll();
        $this->_data['grade'] = GradeModel::getAll();

        if(isset($_POST['addCourse'])){
            
            $course = new CourseModel();
            $course->name = $this->filterString($_POST['name']);
            $course->course_code = $this->filterString($_POST['code']);
            $course->descr = $this->filterString($_POST['description']);
            $course->grade_id_fk = $_POST['grade'];
            $course->status = $_POST['status'];

            if ($course->save()){
              $this->redirect('/course/default');
            }else{
                // handle error
            }
        }
        $this->_view();
    }

    public function editAction(){
        if(isset($this->_params[0])){
        $id = $this->filterInt($this->_params[0]);
        $course = CourseModel::getByPK($id);
        if($course === false)
        { $this->redirect('/course/default'); }
        $this->_data['course'] = $course;
        $this->_data['grade'] = GradeModel::getAll();
        $this->_data['status'] = StatusModel::getAll();

        if(isset($_POST['editCourse']))
        {
            $course->name = $this->filterString($_POST['name']);
            $course->course_code = $this->filterString($_POST['code']);
            $course->descr = $this->filterString($_POST['description']);
            $course->grade_id_fk = $this->filterInt($_POST['grade']);
            $course->status = $this->filterInt($_POST['status']);
            $course->save();
            $this->redirect('/course/default');
        }
        $this->_view();
        }
    }

    public function studentAction(){
        $course = CourseModel::getStudentCourses();
        $this->_data['course']=$course;
        $this->_view();
    }

    public function teacherAction(){
        $course = CourseModel::getTeacherCourses();
        $this->_data['course']=$course;
        $this->_view();
    }
  
}