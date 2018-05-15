<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ParentModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\AddressModel;
use PHPMVC\Models\ErrorModel;
use PHPMVC\Models\StaffModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StudentLevelModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\FileUpload;
use PHPMVC\Lib\InputFilter;

class StudentController extends AbstractController{

    use InputFilter;
    use Helper;

    public function defaultAction(){
        
        $this->_data['students'] = StudentModel::getAll();
        $this->_view();
    }

    public function addAction(){

        $this->_data['country'] = AddressModel::getCountry();
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['grade'] = SclGradeModel::getAll();

        if(isset($_POST['addStudent'])) {

        if (isset($_POST['parentinfo'])) {
            if($_POST['parentinfo'] == "New Parent"){
                $parent = new ParentModel();
                $parent->type_id = $this->filterInt(UserTypesModel::getTypeID("parent"));
                $parent->fname = $this->filterString($_POST['parentfname']);
                $parent->lname = $this->filterString($_POST['parentlname']);
                $parent->gender = $this->filterString($_POST['parentradio']);
                $parent->DOB = $_POST['parentdate'];
                $parent->username = $this->filterString($_POST['parentusername']);
                $parent->phone = $this->filterString($_POST['parentnumberin']);
                $parent->cryptPassword($_POST['passwordin']);
                $parent->email = $this->filterString($_POST['parentemail'] . $_POST['extension']);
                $parent->status = $this->filterInt(1);
                $parent->user_id_fk = $this->filterInt(0);
                $parent->add_id_fk = $this->filterInt($_POST['street']);
                if (isset($_FILES["imageparentinput"]["name"])) {
                    $uploader = new FileUpload($_FILES['imageparentinput']);
                    $uploader->upload();
                    $parent->img = $uploader->getFileName();
                }

                if(UserModel::UsernameExist($this->filterString($_POST['parentusername']))) {
                    $err = StudentModel::PARENT_ERROR;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                }else {

                    $err = StudentModel::PARENT_SUCCESS;
                    $_SESSION["message"][] = ErrorModel::getError($err);

                    if (UserModel::UsernameExist($this->filterString($_POST['usernamein']))) {
                        $err = StudentModel::ERR_EXIST;
                        $_SESSION["message"][] = ErrorModel::getError($err);
                    } else {
                        $parent->save();
                        $user = new StudentModel();
                        $user->type_id = $this->filterInt(UserTypesModel::getTypeID("student"));
                        $user->fname = $this->filterString($_POST['fnamein']);
                        $user->lname = $this->filterString($_POST['lnamein']);
                        $user->gender = $this->filterString($_POST['radioin']);
                        $user->DOB = $_POST['datein'];
                        $user->username = $this->filterString($_POST['usernamein']);
                        $user->cryptPassword($_POST['passwordin']);
                        $user->email = $this->filterString($_POST['emailin'] . $_POST['extension']);
                        $user->status = $this->filterInt($_POST['statusinput']);
                        $user->user_id_fk = $this->filterInt($parent->id);
                        $user->add_id_fk = $this->filterInt($_POST['street']);
                        $user->phone = $this->filterInt($_POST['numberin']);
                        if (isset($_FILES["imagestudentinput"]["name"])) {
                            $uploader = new FileUpload($_FILES['imagestudentinput']);
                            $uploader->upload();
                            $user->img = $uploader->getFileName();
                        }
                        $user->save();
                        //Grade
                        $user_grade = new StudentLevelModel();
                        $user_grade->user_id_fk = $this->filterInt($user->id);
                        $user_grade->scl_grade_id_fk = $this->filterInt($_POST['gradein']);
                        $user_grade->save();
                        $err = StudentModel::ADD_SUCCESS;
                        $_SESSION["message"][] = ErrorModel::getError($err);
                        $this->redirect('/student/default');
                    }

                }
            }else if($_POST['parentinfo'] == "Existing Parent") {
                $parent = ParentModel::getExistingParent($this->filterString($_POST['parentsearch']));

                if (UserModel::UsernameExist($this->filterString($_POST['usernamein']))) {
                    $err = StudentModel::ERR_EXIST;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                } else {
                $user = new StudentModel();
                $user->type_id = $this->filterInt(UserTypesModel::getTypeID("student"));
                $user->fname = $this->filterString($_POST['fnamein']);
                $user->lname = $this->filterString($_POST['lnamein']);
                $user->gender = $this->filterString($_POST['radioin']);
                $user->DOB = $_POST['datein'];
                $user->username = $this->filterString($_POST['usernamein']);
                $user->cryptPassword($_POST['passwordin']);
                $user->email = $this->filterString($_POST['emailin'] . $_POST['extension']);
                $user->status = $this->filterInt($_POST['statusinput']);
                $user->user_id_fk = $this->filterInt($parent->id);
                $user->add_id_fk = $this->filterInt($_POST['street']);
                $user->phone = $this->filterInt($_POST['numberin']);
                if (isset($_FILES["imagestudentinput"]["name"])) {
                    $uploader = new FileUpload($_FILES['imagestudentinput']);
                    $uploader->upload();
                    $user->img = $uploader->getFileName();
                }
                $user->save();
                $user_grade = new StudentLevelModel();
                $user_grade->user_id_fk = $this->filterInt($user->id);
                $user_grade->scl_grade_id_fk = $this->filterInt($_POST['gradein']);
                $user_grade->save();
                    $err = StudentModel::ADD_SUCCESS;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                $this->redirect('/student/default');
                }
            }
                }
        }
        if(isset($_SESSION["message"])){
            $this->message = $_SESSION["message"]; }
        $this->_view();

    }

    public function activateAction(){
        $this->_data['status'] = StatusModel::getAll();
        $id = $this->filterInt($this->_params[0]);
        $user = StudentModel::getByPK($id);

        if($user === false)
        { $this->redirect('/student/default'); }
        $this->_data['users'] = $user;
        if(isset($_POST['activate']))
        {   $user->status = $this->filterInt($_POST['statusinput']);
            $user->update();
            $this->redirect('/student/default');
        }

        $this->_view();
    }

    public function editAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $student = StudentModel::getByPK($id);
            if($student == false){
                $this->redirect("\student");
            }

            $email = explode("@",$student->email);
            $student->email = $email[0];
            $this->_data['student'] = $student;
            $this->_data['status'] = StatusModel::getAll();
            $this->_data['grade'] = SclGradeModel::getAll();


            if(isset($_POST['editStudent'])){

                if(UserModel::UsernameExist($this->filterString($_POST['usernamein']))) {
                    $err = StudentModel::ERR_EXIST;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                }else {
                $student->fname = $this->filterString($_POST['fnamein']);
                $student->lname = $this->filterString($_POST['lnamein']);
                $student->gender = $this->filterString($_POST['radioin']);
                $student->DOB = $_POST['datein'];
                $student->username = $this->filterString($_POST['usernamein']);
                $student->email = $this->filterString($_POST['emailin'] . $_POST['extension']);
                $student->phone = $this->filterInt($_POST['numberin']);
                $student->update();

                $user_grade = StudentLevelModel::getByUserID($id);
                $user_grade->scl_grade_id_fk = $this->filterInt($_POST['gradein']);
                $user_grade->save();

                    $err = StudentModel::ADD_SUCCESS;
                    $_SESSION["message"][] = ErrorModel::getError($err);
                    $this->redirect('/student/default');
            }
                }
            if(isset($_SESSION["message"])){
                $this->message = $_SESSION["message"]; }
            $this->_view();
        }       
    }

    public function upgradeAction(){
        StudentModel::upgradeAll();
        
        $err = StudentModel::SUCCESS_UPGRADE;
        $_SESSION["message"][] = ErrorModel::getError($err);

        if(isset($_SESSION["message"])){
            $this->message = $_SESSION["message"];
        }

        $this->redirect("/student/default");
    }
}