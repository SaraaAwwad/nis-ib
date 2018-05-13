<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CourseModel;
use PHPMVC\Models\SclGradeModel;
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
        $this->_data['course'] = CourseModel::getCourse();
        $this->_view();
    }

    public function addAction(){   

        $this->_data['Levels'] = LevelModel::getAll();
        $this->_data['group'] = CourseGroupModel::getAll();
        $this->_data['status'] = StatusModel::getAll();
       
      
        if(isset($_POST['addcourse'])){
            
            $course = new CourseModel();
            $course->name = $this->filterString($_POST['coursename']);
            $course->course_code = $this->filterString($_POST['coursecode']);
            $course->descr = $this->filterString($_POST['description']);
            $course->level_id_fk = $_POST['level'];
            $course->group_id_fk = $_POST['group'];
            $course->status = $_POST['status'];
            $course->teaching_hours = $this->filterInt($_POST['teaching']);

            if ($course->save()){
              $this->redirect('/course/default');
            }else{
                // handle error
            }

        }

        $this->_view();
    	
    }

    public function editAction(){

        $id = $this->filterInt($this->_params[0]);
        $course = CourseModel::getByPK($id);
        if($course === false)
        { $this->redirect('/course/default'); }
        $this->_data['course'] = $course;
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['group'] = CourseGroupModel::getAll();
        $this->_data['Levels'] = LevelModel::getAll();
       
        if(isset($_POST['updatecourse']))
        {
            $course->name = $this->filterString($_POST['coursename']);
            $course->course_code = $this->filterString($_POST['coursecode']);
            $course->descr = $this->filterString($_POST['description']);
            $course->level_id_fk = $_POST['level'];
            $course->group = $_POST['group'];
            $course->status = $this->filterInt($_POST['status']);
            $course->teaching_hours = $this->filterInt($_POST['teaching']);
            

            $course->save();

            $this->redirect('/course/default');
        }
        $this->_view();
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